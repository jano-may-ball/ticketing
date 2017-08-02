<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2017 Andrew Ying
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v3.0 as
 * published by the Free Software Foundation.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Jano\Contracts;

use Jano\Models\Attendee;
use Jano\Models\Charge;
use Jano\Models\TransferRequest;

interface TransferRequestContract
{
    /**
     * @param \Jano\Models\Attendee $attendee
     * @param \Jano\Models\Charge $charge
     * @param array $data
     * @return \Jano\Models\TransferRequest
     */
    public function store(Attendee $attendee, Charge $charge, $data);

    /**
     * @param \Jano\Models\TransferRequest $request
     * @param array $data
     * @return \Jano\Models\TransferRequest
     */
    public function update(TransferRequest $request, $data);

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getPending();

    /**
     * @param \Jano\Models\TransferRequest $request
     * @return \Jano\Models\TransferRequest
     */
    public function process(TransferRequest $request);

    /**
     * @param \Jano\Models\TransferRequest $request
     * @return void
     */
    public function destroy(TransferRequest $request);
}