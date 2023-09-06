<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Installer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Installer>
     */
    public static string $model = \App\Models\Installer::class;

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
        'post_code'
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
            //ID::make()->sortable(),
            MorphMany::make('Files', 'files')->nullable(),
            Text::make('First Name', 'first_name')
                ->sortable(),
            Text::make('Last Name', 'last_name')->sortable(),
            Text::make('Email', 'email')->sortable(),
            Text::make('Telephone Number', 'telephone_number')->sortable(),
            Text::make('House Name Or Number', 'house_name_or_number')->sortable(),
            Text::make('Street Name', 'street_name')->sortable(),
            Text::make('Address Line 2', 'address_line_2')->sortable()->hideFromIndex(),
            Text::make('Address Line 3', 'address_line_3')->sortable()->hideFromIndex(),
            Text::make('Post Code', 'post_code')->sortable()->hideFromIndex(),
            Text::make('Work In Postcodes', 'work_in_postcodes')->sortable()->hideFromIndex(),
            Text::make('Bank Account Number', 'bank_account_number')->sortable()->hideFromIndex(),
            Text::make('Bank Sort Code', 'bank_sort_code')->sortable()->hideFromIndex(),
            Number::make('Company Registration Number', 'company_registration_number')->sortable()->hideFromIndex(),
            Text::make('Gas Safe License Number', 'gas_safe_license_number')->sortable()->hideFromIndex(),
            Boolean::make('Registered For Vat', 'registered_for_vat')->hideFromIndex(),
            Text::make('Company Vat Number', 'company_vat_number')->sortable()->hideFromIndex(),
            Text::make('Gas Safe Expiry Date', 'gas_safe_expiry_date')->sortable()->hideFromIndex(),
            Text::make('Analyser Calibration Certification Expiry Date', 'analyser_calibration_certification_expiry_date')->sortable()->hideFromIndex(),
            Text::make('DBS Check Expiry Date', 'dbs_check_expiry_date')->sortable()->hideFromIndex(),
            Text::make('Registered For Vat Subject', 'registered_for_vat_subject', function () {
                $decodedRegisteredForVatSubject = json_decode($this->registered_for_vat_subject);

                return implode(',', $decodedRegisteredForVatSubject);
            })->sortable()->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @return bool
     */
    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function authorizedToReplicate(Request $request): bool
    {
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function authorizedToUpdate(Request $request): bool
    {
        return false;
    }

    /**
     * @return string[]
     */
    public static function searchableColumns(): array
    {
        return [
            'post_code'
        ];
    }
}
