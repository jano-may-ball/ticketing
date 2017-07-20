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

use Jano\Models\Order;
use Jano\Models\Payment;

interface PaymentContract
{
    /**
     * @param array $data
     * @param \Jano\Models\Order|null $order
     * @return \Jano\Models\Payment
     */
    public function store($data, Order $order = null);

    /**
     * @param \Jano\Models\Payment $payment
     * @param \Jano\Models\Order $order
     * @return \Jano\Models\Payment
     */
    public function associate(Payment $payment, Order $order);

    /**
     * @param \Jano\Models\Payment $payment
     */
    public function destroy(Payment $payment);
}