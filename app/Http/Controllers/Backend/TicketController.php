<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2017 Andrew Ying
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v3.0 as
 * published by the Free Software Foundation. You must preserve all legal
 * notices and author attributions present.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Jano\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Validator;
use Jano\Contracts\TicketContract;
use Jano\Http\Controllers\Controller;
use Jano\Http\Traits\RendersAjaxView;
use Jano\Models\Ticket;

class TicketController extends Controller
{
    use RendersAjaxView;

    /**
     * @var \Jano\Contracts\TicketContract
     */
    protected $contract;

    /**
     * TicketController constructor.
     *
     * @param \Jano\Contracts\TicketContract $contract
     */
    public function __construct(TicketContract $contract)
    {
        $this->middleware(['auth', 'staff']);
        $this->contract = $contract;
    }

    /**
     * Render the index page for staff.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->ajaxView(
            $request,
            'backend.tickets.index',
            $this->contract->search($request->get('q'))
        );
    }

    /**
     * Render the ticket type creation page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tickets.create');
    }

    /**
     * Return the validator instance.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function storeValidator($data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'price' => 'required|numeric|min:0'
        ]);
    }

    /**
     * Store the newly created ticket class instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->storeValidator($data);
        $this->contract->store($data);

        return redirect()->route('backend.tickets.index');
    }

    /**
     * Return the validator instance.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function updateValidator($data)
    {
        return Validator::make($data, [
            'price' => 'numeric|min:0'
        ]);
    }

    /**
     * Update the ticket class instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Jano\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->only(['name', 'price']);

        $this->updateValidator($data);
        $this->contract->update($ticket, $data);

        return redirect()->route('backend.tickets.index');
    }
}
