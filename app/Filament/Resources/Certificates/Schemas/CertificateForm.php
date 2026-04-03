<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('certificate_id')
                    ->required(),
                ToggleButtons::make('status')
                    ->label('Would you like this certificate to be verified?')
                    ->boolean()
                    ->inline(),
                FileUpload::make('certificate_path')
                    ->required()
                    ->disk('public')
                    ->directory('images/uploads')
                    ->acceptedFileTypes(['application/pdf']),
            ]);
    }
}
