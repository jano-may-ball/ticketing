<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2019 Andrew Ying and other contributors.
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License
 * v3.0 supplemented by additional permissions and terms as published at
 * COPYING.md.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

namespace Jano\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Jano\Models\Traits\Chargeable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Attendee
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property int $charge_id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property boolean $primary_ticket_holder
 * @property int $ticket_id
 * @property boolean $checked_in
 * @property \Carbon\Carbon $checked_in_at
 *
 */
class Attendee extends Model implements AuditableContract
{
    use Chargeable, Notifiable, SoftDeletes, Auditable;

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['user', 'charge'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The relationships to eager-load automatically.
     *
     * @var array
     */
    protected $with = ['ticket'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'primary_ticket_holder' => 'boolean',
        'checked_in' => 'boolean',
    ];

    /**
     * The user associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Jano\Models\User');
    }

    /*
     * The ticket type associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('Jano\Models\Ticket');
    }

    /*
     * The ticket request associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticketRequest()
    {
        return $this->hasOne('Jano\Models\TicketRequest');
    }

    /*
     * The transfer request associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transferRequest()
    {
        return $this->hasOne('Jano\Models\TransferRequest');
    }

    /**
     * Get list of attributes.
     *
     * @return array
     */
    public static function getAttributeListing()
    {
        return [
            'title',
            'first_name',
            'last_name',
            'email',
            'primary_ticket_holder',
            'ticket_id'
        ];
    }
}
