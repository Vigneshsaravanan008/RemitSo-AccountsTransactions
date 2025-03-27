@section('meta-title')
    <title>RemitSo | Accounts</title>
@endsection
<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1>Accounts</h1>
                        <div class="float-left">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Accounts</li>
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
                                            <th>Account Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($accounts as $key => $account)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $account->account_number }}</td>
                                                <td>{{ $account->account_name }}</td>
                                                <td>{{ Carbon\Carbon::parse($account->created_at)->format("D-m Y H:i:s") }}</td>
                                                <td>
                                                    <label class="switch_box">
                                                        <input type="checkbox" class="checkbox" data-id="{{$account->id}}" {{($account->status==1)?"checked":""}}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                        wire:click="editAccount('{{ $account->id }}')"><i
                                                            class="far fa-edit"></i></button>
                                                    <button class="btn btn-danger delete"
                                                        data-value="{{ $account->id }}"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Accounts</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <ul class="pagination float-right">
                            <li class="page-item">{{ $accounts->links() }}</li>
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
                <form  wire:submit="addAccount">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Title">Account Name</label>
                                    <input type="text" class="form-control @error('account_name') is-invalid @enderror"
                                        wire:model="account_name" id="account_name" placeholder="Enter Account Name">
                                    @error('account_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Blog Category">Account Type</label>
                                    <select class="form-control select2 @error('account_type') is-invalid @enderror" wire:model="account_type">
                                        <option value="">Select Account Type</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Business">Business</option>
                                    </select>
                                    @error('account_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Slug">Currency</label>
                                    <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                        wire:model="currency" id="currency" placeholder="Enter Currency">
                                    @error('currency')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Slug">Initial Balance</label>
                                    <input type="text" class="form-control @error('balance') is-invalid @enderror"
                                        wire:model="balance" id="balance" placeholder="Enter Initial Balance (optional)">
                                    @error('balance')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer float-right">
                        <button type="button" wire:click="addAccount" class="btn btn-primary">Submit</button>
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
                <form  wire:submit="updateAccount">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Title">Account Name</label>
                                    <input type="text" class="form-control @error('account_name') is-invalid @enderror"
                                        wire:model="account_name" id="account_name" placeholder="Enter Account Name">
                                    @error('account_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Title">Account Number</label>
                                    <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                                        wire:model="account_number" id="account_number" readonly placeholder="Enter Account Name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Blog Category">Account Type</label>
                                    <select class="form-control select2 @error('account_type') is-invalid @enderror" wire:model="account_type">
                                        <option value="">Select Account Type</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Business">Business</option>
                                    </select>
                                    @error('account_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Slug">Currency</label>
                                    <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                        wire:model="currency" id="currency" placeholder="Enter Currency">
                                    @error('currency')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Slug">Initial Balance</label>
                                    <input type="text" class="form-control @error('balance') is-invalid @enderror"
                                        wire:model="balance" id="balance" placeholder="Enter Initial Balance (optional)">
                                    @error('balance')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer float-right">
                        <button type="button" wire:click="updateAccount" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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

        $(document).ready(function(){
            $(".checkbox").on('click',function(){
                var value=$(this).data('id');
                @this.statusAccount(value);
            })
        });
    </script>
@endpush
