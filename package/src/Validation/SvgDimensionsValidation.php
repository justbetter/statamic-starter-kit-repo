<?php

namespace JustBetter\StatamicStarterKit\Validation;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class SvgDimensionsValidation
{
    public static function register(): void
    {
        Validator::extend(
            'svg_has_dimensions',
            static fn (string $attribute, mixed $value): bool => self::passes($attribute, $value),
            __('validation.svg_has_dimensions')
        );
        Validator::replacer(
            'svg_has_dimensions',
            static fn (string $message, string $attribute): string => self::message($message, $attribute)
        );
    }

    public static function passes(string $attribute, mixed $value): bool
    {
        if (! $value instanceof UploadedFile) {
            return false;
        }

        if (! str_ends_with(strtolower($value->getClientOriginalName()), '.svg')) {
            return false;
        }

        $svg = @simplexml_load_string($value->getContent());

        if ($svg === false || $svg->getName() !== 'svg') {
            return false;
        }

        $attributes = $svg->attributes();

        return isset($attributes['width'], $attributes['height']) || isset($attributes['viewBox']);
    }

    public static function message(string $message, string $attribute): string
    {
        return __('validation.svg_has_dimensions', ['attribute' => $attribute]);
    }
}
