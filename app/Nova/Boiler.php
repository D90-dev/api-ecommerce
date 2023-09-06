<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Boiler extends Resource
{
    public static $displayInNavigation = true;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Boiler>
     */
    public static string $model = \App\Models\Boiler::class;

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
            HasOne::make('File', 'file')->nullable(),
            BelongsToMany::make('Products', 'products', Product::class)->fields(function () use($request) {
                return [
                    Select::make('Is Free', 'is_free')->hideFromIndex()->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])->default(function () {
                        return 0;
                    })
                ];
            })->display('name'),
            BelongsToMany::make('Services', 'services', Service::class)->display('title')->fields(function () use($request) {
                return [
                    Select::make('Is Free', 'is_free')->hideFromIndex()->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])->default(function () {
                        return 0;
                    })
                ];
            }),
            Image::make('File', function ($value) {
                return $value->file ? $value->file->path : null;
            })->disableDownload(),
            Text::make('Title')
                ->sortable(),
            Textarea::make('Description')->showOnPreview(),
            Number::make('Price')->step(0.01),
            Text::make('Additional Info', 'additional_info'),
            Number::make( 'Old Price', 'old_price')->step(0.01),
            Number::make( 'Radiators Count', 'radiators_count'),
            Number::make( 'Hot Water Flow Rate', 'hot_water_flow_rate')->step(0.01),
            Number::make( 'Heating Output', 'heating_output')->step(0.01),
            Number::make('Warranty')->step(0.01),
            Number::make('Efficiency')->step(0.01),
            Number::make('Height')->step(0.01),
            Number::make('Width')->step(0.01),
            Number::make('Depth')->step(0.01),
            Boolean::make('Hydrogen Blend', 'hydrogen_blend'),
            Boolean::make( 'Best Seller', 'best_seller'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
