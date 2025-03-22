<div class="table-responsive">
    <table class="table search-table align-middle text-nowrap">
        <thead class="header-item">
            <tr>
                <th>Txn Id</th>
                <th>Channel</th>
                <th>Account</th>
                <th>Amount</th>
                <th>Phone No</th>
                <th>Ext Txn Id</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <!-- start row -->
                <tr wire:key="{{ $payment->id }}" class="search-items">
                    <td>
                        <span
                            data-ext-txn-id="{{ Str::substr($payment->id, 0, 10) }}">{{ Str::substr($payment->id, 0, 10) }}</span>
                    </td>
                    <td>
                        <h6 class="mb-0" data-channel="Airtel">Airtel</h6>
                    </td>
                    <td>
                        <span data-ref="{{ $payment->customer->ref }}">{{ $payment->customer->ref }}</span>
                    </td>
                    <td>{{ $payment->formattedAmount }}</td>
                    <td>
                        <span data-phone="{{ $payment->msisdn }}">{{ $payment->msisdn }}</span>
                    </td>
                    <td>
                        <span data-ext-txn-id="{{ $payment->external_id }}">{{ $payment->external_id }}</span>
                    </td>
                    <td>
                        <span
                            class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                    </td>
                    <td>
                        <x-action-buttons viewUrl="{{ route('topup.payment.details', $payment->id) }}" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">There are no payments assigned to this user!</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
