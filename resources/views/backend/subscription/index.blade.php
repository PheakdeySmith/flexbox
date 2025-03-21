@extends('backend.layouts.app')

@section('title', 'Subscriptions')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Subscriptions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subscriptions</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Subscriptions</h3>
                                <div class="card-tools">
                                    <a href="{{ route('subscription.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Create New Subscription
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                @if (count($subscriptions) > 0)
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User</th>
                                                <th>Plan</th>
                                                <th>Status</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Auto Renew</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subscriptions as $subscription)
                                                <tr>
                                                    <td>{{ $subscription->id }}</td>
                                                    <td>{{ $subscription->user->name ?? 'N/A' }}</td>
                                                    <td>
                                                        @if ($subscription->plan)
                                                            {{ $subscription->plan->name }}
                                                        @else
                                                            <span class="text-danger">Missing Plan</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($subscription->status == 'active')
                                                            <span class="badge badge-success">Active</span>
                                                        @elseif($subscription->status == 'canceled')
                                                            <span class="badge badge-danger">Canceled</span>
                                                        @elseif($subscription->status == 'expired')
                                                            <span class="badge badge-warning">Expired</span>
                                                        @else
                                                            <span
                                                                class="badge badge-secondary">{{ $subscription->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $subscription->start_date->format('M d, Y') }}</td>
                                                    <td>
                                                        @if ($subscription->plan && $subscription->plan->duration_in_days > 3650)
                                                            Lifetime
                                                        @else
                                                            {{ $subscription->end_date->format('M d, Y') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($subscription->auto_renew)
                                                            <span class="badge badge-success">Yes</span>
                                                        @else
                                                            <span class="badge badge-danger">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('subscription.show', $subscription->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('subscription.edit', $subscription->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                            data-id="{{ $subscription->id }}"
                                                            data-url="{{ route('subscription.destroy', $subscription->id) }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info m-3">
                                        No subscriptions found. <a href="{{ route('subscription.create') }}">Create a new
                                            subscription</a>.
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $subscriptions->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.delete-btn');

        // Add click event listener to each button
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const subscriptionId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Delete Subscription',
                    text: 'Are you sure you want to delete this subscription?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form element
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = deleteUrl;
                        form.style.display = 'none';

                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);

                        // Add method spoofing for DELETE
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        form.appendChild(methodField);

                        // Append form to body, submit it, then remove it
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
