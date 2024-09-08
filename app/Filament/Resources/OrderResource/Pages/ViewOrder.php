<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use EightyNine\Approvals\Models\ApprovableModel;
use EightyNine\Approvals\Traits\HasApprovalHeaderActions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{

    use HasApprovalHeaderActions;


    protected static string $resource = OrderResource::class;


    protected function getOnCompletionAction(): Action
    {
        return Action::make("Done")
            ->disabled()
            ->color("success");
    }
}
