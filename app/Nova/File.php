<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;

class File extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\File>
     */
    public static string $model = \App\Models\File::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Image::make('Image', 'path')
                ->store(function (Request $request, $model) {
                    if ($request->segment(2) === 'posts')
                        $folder = $request->segment(2).'_thumbnails';
                    else
                        $folder = $request->segment(2);

                    return $request->file('file')['path']->store($folder, 'public');
                })
                ->disableDownload()
                ->hideFromDetail(),
        ];
    }

    public static function availableForNavigation(Request $request): bool
    {
        return false;
    }
}
