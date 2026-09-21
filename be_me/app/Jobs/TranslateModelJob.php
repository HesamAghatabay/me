<?php

namespace App\Jobs;

use App\Ai\Agents\TranslatorAgent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class TranslateModelJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * تعداد دفعات تلاش مجدد در صورت خطای شبکه یا API
     */
    public int $tries = 3;

    /**
     * مدت زمان وقفه قبل از تلاش مجدد (به ثانیه)
     */
    public int $backoff = 10;

    /**
     * مدل مورد نظر برای ترجمه فیلدها
     */
    public function __construct(public Model $model)
    {
    }

    /**
     * اجرای عملیات استخراج، ترجمه با ایجنت و ذخیره در دیتابیس
     */
    public function handle(): void
    {
        // اطمینان از مجهز بودن مدل به تریت و فیلدهای Spatie Translatable
        if (! property_exists($this->model, 'translatable') || empty($this->model->translatable)) {
            return;
        }

        $fieldsToTranslate = [];

        foreach ($this->model->translatable as $field) {
            $persianValue = $this->model->getTranslation($field, 'fa', false);

            if (filled($persianValue)) {
                $fieldsToTranslate[$field] = $persianValue;
            }
        }

        if (empty($fieldsToTranslate)) {
            return;
        }

        try {
            $agent = new TranslatorAgent();

            // ارسال فیلدهای فارسی در قالب JSON به ایجنت
            $prompt = json_encode($fieldsToTranslate, JSON_UNESCAPED_UNICODE);
            $response = $agent->prompt($prompt);

            $rawContent = (string) $response;

            // پاک‌سازی احتمالی فرمت‌بندی مارک‌داون
            $cleanJson = trim(preg_replace('/^```(?:json)?\s*|\s*```$/i', '', trim($rawContent)));
            $translations = json_decode($cleanJson, true);

            if (! is_array($translations)) {
                Log::warning('TranslatorAgent returned non-JSON response', [
                    'model' => get_class($this->model),
                    'id' => $this->model->getKey(),
                    'raw' => $rawContent,
                ]);
                return;
            }

            // ثبت مقادیر ترجمه‌شده انگلیسی در مدل
            foreach ($translations as $field => $englishText) {
                if (in_array($field, $this->model->translatable) && filled($englishText)) {
                    $this->model->setTranslation($field, 'en', $englishText);
                }
            }

            // ذخیره بدون تریگر شدن مجدد هوک‌ها
            $this->model->saveQuietly();

            Log::info('Model translated successfully via TranslatorAgent', [
                'model' => get_class($this->model),
                'id' => $this->model->getKey(),
            ]);
        } catch (Throwable $e) {
            Log::error('Translation job encountered an error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'id' => $this->model->getKey(),
            ]);

            throw $e;
        }
    }
}
