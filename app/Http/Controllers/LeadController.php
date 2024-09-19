<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreRequest;
use App\Http\Requests\Lead\UpdateRequest;
use App\Models\Lead;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 1;

        Lead::create($data);

        return redirect()->back();
    }

    public function edit(Lead $lead): View
    {
        $statuses = Status::all();

        return view('lead.edit', compact('lead', 'statuses'));
    }

    public function update(UpdateRequest $request, Lead $lead): RedirectResponse
    {
        $data = $request->validated();

        $lead->update($data);

        return redirect()->route('home');
    }

    public function delete(Lead $lead): RedirectResponse
    {
        $lead->delete();
        return redirect()->route('home');
    }

    public function updateStatus(Request $request, Lead $lead): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|exists:statuses,id',
        ]);

        $lead->update([
            'status' => $data['status'],
        ]);

        return redirect()->back();
    }
}
