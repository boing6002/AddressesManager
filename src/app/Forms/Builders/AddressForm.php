<?php

namespace LaravelEnso\AddressesManager\app\Forms\Builders;

use LaravelEnso\AddressesManager\app\Enums\BuildingTypes;
use LaravelEnso\AddressesManager\app\Enums\StreetTypes;
use LaravelEnso\AddressesManager\app\Models\Address;
use LaravelEnso\FormBuilder\app\Classes\Form;

class AddressForm
{
    private const FormPath = __DIR__.'/../Templates/address.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form($this->form());
    }

    public function create()
    {
        return $this->form->title('Insert')
            ->options('street_type', StreetTypes::select())
            ->options('building_type', BuildingTypes::select())
            ->create();
    }

    public function edit(Address $address)
    {
        return $this->form->title('Edit')
            ->actions(['update'])
            ->options('street_type', StreetTypes::select())
            ->options('building_type', BuildingTypes::select())
            ->edit($address);
    }

    private function form()
    {
        $form = app_path('Forms/vendor/address.json');

        if (\File::exists($form)) {
            return $form;
        }

        return self::FormPath;
    }
}
