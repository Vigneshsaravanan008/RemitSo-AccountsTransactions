@section('meta-title')
    <title>RemitSo | Transactions</title>
@endsection
<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1>Transactions</h1>
                        <div class="float-left">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Transactions</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right mb-3">
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-lg"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account Number</th>
                                            <th>Account Name</th>
                                            <th>Account Balance</th>
                                            <th>Transaction Created</th>
                                            <th>Transaction Amount</th>
                                            <th>Transaction Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transaction->account->account_number }}</td>
                                                <td>{{ $transaction->account->account_name }}</td>
                                                <td>{{ $transaction->account->balance }}</td>
                                                <td>{{ Carbon\Carbon::parse($transaction->created_at)->format("D-m Y H:i:s A") }}</td>
                                                <td>{{$transaction->amount}}</td>
                                                <td>
                                                    @if($transaction->type=="Credit")
                                                        <span class="text-success"><i class="fas fa-arrow-up"></i> Credit</span>
                                                    @else
                                                        <span class="text-danger"> <i class="fas fa-arrow-down"></i>Debit</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                        wire:click="showTransaction('{{ $transaction->id }}')"><i
                                                            class="far fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Transactions</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <ul class="pagination float-right">
                            <li class="page-item">{{ $transactions->links() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div wire:ignore.self class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $model_title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  wire:submit="addTransaction">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Blog Category">Accounts</label>
                                    <select class="form-control @error('account_id') is-invalid @enderror" wire:model="account_id">
                                        <option value="">Select Account Type</option>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->account_name}} ({{$account->account_number}})</option>
                                        @endforeach
                                    </select>
                                    @error('account_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Title">Amount</label>
                                    <input type="text" class="form-control @error('amount') is-invalid @enderror"
                                        wire:model="amount" id="amount" placeholder="Enter Amount">
                                    @error('amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Blog Category">Transaction Type</label>
                                    <select class="form-control select2 @error('type') is-invalid @enderror" wire:model="type">
                                        <option value="">Select Transaction Type</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Debit">Debit</option>
                                    </select>
                                    @error('type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                                        wire:model="description" placeholder="Enter Description"></textarea>
                                    @error('description')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer float-right">
                        <button type="button" wire:click="addTransaction" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="edit-modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $model_title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Blog Category">Accounts</label>
                                <select class="form-control @error('account_id') is-invalid @enderror" wire:model="account_id" readonly>
                                    <option value="">Select Account Type</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}} ({{$account->account_number}})</option>
                                    @endforeach
                                </select>
                                @error('account_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Title">Amount</label>
                                <input type="text" class="form-control @error('amount') is-invalid @enderror"
                                    wire:model="amount" id="amount" placeholder="Enter Amount" readonly>
                                @error('amount')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Blog Category">Transaction Type</label>
                                <select class="form-control select2 @error('type') is-invalid @enderror" wire:model="type" readonly>
                                    <option value="">Select Transaction Type</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Debit">Debit</option>
                                </select>
                                @error('type')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                                    wire:model="description" placeholder="Enter Description" readonly></textarea>
                                @error('description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        Livewire.on('dismissmodal', function(data) {
            (data.parameter == 400) ? toastr.error(data.message): toastr.success(data.message);
            setTimeout(()=>{
                (data.parameter == 200)?location.reload():"";
            },2000);
        });

        Livewire.on('message', function(data) {
            if (data.parameter == 200) {
                $("#edit-modal-lg").modal('show');
            } else {
                toastr.error(data.message);
            }
        });
    </script>
@endpush
