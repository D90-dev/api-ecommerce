<?php

namespace App\Services;

use App\Models\File;
use App\Models\Installer;
use Illuminate\Support\Facades\DB;

class InstallerService
{
    /**
     * @param array $data
     * @param array $files
     * @return void
     */
    public function createInstaller(array $data, array $files): void
    {
        $installer = new Installer;

        $installer->first_name = $data['firstName'];
        $installer->last_name = $data['lastName'];
        $installer->email = $data['email'];
        $installer->registered_for_vat_subject = $data['registeredForVatSubject'];
        $installer->registered_for_vat = $data['registeredForVat'];
        $installer->dbs_check_expiry_date = date('Y-m-d H:i:s', strtotime($data['dbsCheckExpiryDate']));
        $installer->analyser_calibration_certification_expiry_date = date('Y-m-d H:i:s', strtotime($data['analyserCalibrationCertificationExpiryDate']));
        $installer->public_liability_expiry_date = date('Y-m-d H:i:s', strtotime($data['publicLiabilityExpiryDate']));
        $installer->gas_safe_expiry_date = date('Y-m-d H:i:s', strtotime($data['gasSafeExpiryDate']));
        $installer->gas_safe_license_number = $data['gasSafeLicenseNumber'];
        $installer->company_vat_number = $data['companyVatNumber'];
        $installer->street_name = $data['streetName'];
        $installer->address_line_2 = $data['addressLine2'];
        $installer->address_line_3 = $data['addressLine3'];
        $installer->bank_sort_code = $data['bankSortCode'];
        $installer->bank_account_number = $data['bankAccountNumber'];
        $installer->post_code = $data['postcode'];
        $installer->company_registration_number = $data['companyRegistrationNumber'];
        $installer->telephone_number = $data['telephoneNumber'];
        $installer->house_name_or_number = $data['houseNameOrNumber'];
        $installer->work_in_postcodes = $data['workInPostcodes'];

        DB::transaction(function () use($installer, $data, $files) {
            $installer->save();

            $this->storeFiles($installer, $files);
        });
    }

    /**
     * @param Installer $installer
     * @param array $files
     * @return true
     */
    public function storeFiles(Installer $installer, array $files): bool
    {
        foreach ($files as $file)
        {
            $path = $file->store('installers', 'public');

            $fileRecord = new File([
                'path' => $path,
            ]);

            $installer->files()->save($fileRecord);
        }

        return true;
    }
}
