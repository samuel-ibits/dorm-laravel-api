<?php

namespace App\Providers;

use App\Events\BillingEvent;
use App\Events\DocumentShared;
use App\Events\InvitationAccepted;
use App\Events\InvitationCreated ;
use App\Events\PasswordChanged;
use App\Events\ProblemReported;
use App\Events\TransactionCompleted;
use App\Events\TransactionInitialized;
use App\Listeners\BillingListener;
use App\Listeners\DocumentShared as ListenForDocumentShared;
use App\Listeners\InvitationAccepted as ListenForInvitationAccepted;
use App\Listeners\InvitationCreated as ListenForInvitationCreatedEvent;
use App\Listeners\NewSignupListener;
use App\Listeners\PasswordChanged as ListenForPasswordChanged;
use App\Listeners\ProblemReported as ListenForProblemReported;
use App\Listeners\TimeToAdjustPrivileges;
use App\Listeners\TransactionCompleted as ListenForTransactionCompleted;
use App\Listeners\TransactionInitialized as ListenForTransactionInitialized;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Stancl\Tenancy\Events\DatabaseCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            NewSignupListener::class,
        ],
        DatabaseCreated::class => [
            TimeToAdjustPrivileges::class,
        ],
        InvitationCreated::class => [
            ListenForInvitationCreatedEvent::class,
        ],
        InvitationAccepted::class => [
            ListenForInvitationAccepted::class,
        ],
        TransactionInitialized::class => [
            ListenForTransactionInitialized::class,
        ],
        TransactionCompleted::class => [
            ListenForTransactionCompleted::class,
        ],
        PasswordChanged::class => [
            ListenForPasswordChanged::class,
        ],
        DocumentShared::class => [
            ListenForDocumentShared::class,
        ],
        ProblemReported::class => [
            ListenForProblemReported::class,
        ],
        BillingEvent::class => [
            BillingListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
