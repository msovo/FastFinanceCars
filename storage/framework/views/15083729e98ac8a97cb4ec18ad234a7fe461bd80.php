

<?php $__env->startSection('content'); ?>

    <h1>Manage Leads</h1>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">Apply Filters</button>
            <button type="button" class="btn btn-secondary" id="resetFilters">Reset Filters</button> 
        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Apply
 Filters</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="filterDate">Filter by Date</label>
                        <input type="date" id="filterDate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="filterStatus">Filter by Status</label>
                        <select id="filterStatus" class="form-control">
                            <option value="">All</option>

                            <option value="-1">Declined</option>
                            <option value="1">Confirmed</option>
                            <option value="2">Administrator Viewed</option>
                            <option value="3">Pre-Approved</option>
                            <option value="-2">Pre-Approval Declined</option>
                            <option value="4">Deal Approved</option>
                            <option value="-3">Deal Declined</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button
 type="button" class="btn btn-primary" id="applyFilters">Apply Filters</button> 
                </div>
            </div>
        </div>
    </div>


    <table class="table" id="leads-table">
        <thead>
            <tr>
                <th>Quote ID</th>
                <th>Vehicle</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>#<?php echo e($lead->id); ?></td>
                    <td><?php echo e($lead->listing->vehicle->make); ?> <?php echo e($lead->listing->vehicle->model); ?></td>
                    <td><?php echo e($lead->user ? $lead->user->name : $lead->name); ?></td>
                    <td>
                        <?php switch($lead->status):
                            case (-1): ?>
                                Declined
                                <?php break; ?>
                            <?php case (1): ?>
                                Confirmed
                                <?php break; ?>
                            <?php case (2): ?>
                                Administrator Viewed
                                <?php break; ?>
                            <?php case (3): ?>
                                Pre-Approved
                                <?php break; ?>
                            <?php case (-2): ?>
                                Pre-Approval Declined
                                <?php break; ?>
                            <?php case (4): ?>
                                Deal Approved
                                <?php break; ?>
                            <?php case (-3): ?>
                                Deal Declined
                                <?php break; ?>
                            <?php default: ?>
                                Unknown
                        <?php endswitch; ?>
                    </td>
                    <td><?php echo e($lead->created_at); ?></td>

                    <td>
                        <button class="btn btn-info view-message-btn" data-id="<?php echo e($lead->id); ?>" data-vehicle="<?php echo e($lead->listing->vehicle->make); ?> <?php echo e($lead->listing->vehicle->model); ?>" data-customer-message="<?php echo e($lead->message); ?>" data-dealer-message="<?php echo e($lead->dealer_message); ?>" data-vehicle-id="<?php echo e($lead->listing->vehicle->vehicle_id); ?>">View Message</button>
                        <button class="btn btn-success approve-btn" data-id="<?php echo e($lead->id); ?>">Confirm</button>
                        <button class="btn btn-danger decline-btn" data-id="<?php echo e($lead->id); ?>">Decline</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- View Message Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewMessageModalLabel">Lead Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Vehicle:</strong> <span id="vehicleDetails"></span></p>
                    <p><strong>Customer Message:</strong></p>
                    <p id="customerMessage"></p>
                    <p><strong>Dealer Message:</strong></p>
                    <p id="dealerMessage"></p>
                    <a href="#" id="viewCarButton" class="btn btn-primary mt-2">View Details</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Lead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Note! You confirm that the vehicle is available and the finance team must process the deal with the bank. You can track your status activity of the leads by visiting the leads management page.</p>
                    <form id="approveForm">
                        <div class="form-group">
                            <label for="approveMessage">Message (optional)</label>
                            <textarea class="form-control" id="approveMessage" name="message" rows="3"></textarea>
                        </div>
                        <input type="hidden" id="approveLeadId" name="lead_id">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Decline Modal -->
    <div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel">Decline Lead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Note! When you decline the lead, please ensure you specify the reason, such as out of stock or other applicable reasons, so we can inform the customer and provide alternatives. We serve as a middleman between the dealership and the customer.</p>
                    <form id="declineForm">
                        <div class="form-group">
                            <label for="declineMessage">Message (required)</label>
                            <textarea class="form-control" id="declineMessage" name="message" rows="3" required></textarea>
                        </div>
                        <input type="hidden" id="declineLeadId" name="lead_id">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    var table = $('#leads-table').DataTable();

    $('#applyFilters').on('click', function() { 
        var selectedDate = $('#filterDate').val();
        var selectedStatus = $('#filterStatus').val();
        if (selectedDate) {
            table.column(4).search(selectedDate).draw();
        } else {
            table.column(4).search('').draw();
        }
        
        var statusDescription = '';

switch (selectedStatus) {
    case '-1':
        statusDescription = 'Declined';
        break;
    case '1':
        statusDescription = 'Confirmed';
        break;
    case '2':
        statusDescription = 'Administrator Viewed';
        break;
    case '3':
        statusDescription = 'Pre-Approved';
        break;
    case '-2':
        statusDescription = 'Pre-Approval Declined';
        break;
    case '4':
        statusDescription = 'Deal Approved';
        break;
    case '-3':
        statusDescription = 'Deal Declined';
        break;
    default:
        statusDescription = '';
}

    if (statusDescription) {
        table.column(3).search(statusDescription).draw();
    } else {
        table.column(3).search('').draw();
    }
        
        $('#filterModal').modal('hide'); 
    });

    $('#resetFilters').on('click', function() { 
        $('#filterDate').val(''); 
        $('#filterStatus').val(''); 
        table.search('').columns().search('').draw(); 
    });



    $('.view-message-btn').on('click', function() {
        var vehicle = $(this).data('vehicle');
        var customerMessage = $(this).data('customer-message');
        var dealerMessage = $(this).data('dealer-message');
        var listingId = $(this).data('listing-id');
        $('#vehicleDetails').text(vehicle);
        $('#customerMessage').text(customerMessage);
        $('#dealerMessage').text(dealerMessage);
        $('#viewCarButton').attr('href', '<?php echo e(url('cars/show')); ?>/' + listingId);
        $('#viewMessageModal').modal('show');
    });

    $('.approve-btn').on('click', function() {
        var leadId = $(this).data('id');
        $('#approveLeadId').val(leadId);
        $('#approveModal').modal('show');
    });

    $('.decline-btn').on('click', function() {
        var leadId = $(this).data('id');
        $('#declineLeadId').val(leadId);
        $('#declineModal').modal('show');
    });

    $('#approveForm').on('submit', function(e) {
        e.preventDefault();
        var leadId = $('#approveLeadId').val();
        var message = $('#approveMessage').val();
        $.ajax({
            url: '/leads/' + leadId + '/approve',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                message: message
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('AJAX call failed:', error);
            }
        });
    });

    $('#declineForm').on('submit', function(e) {
        e.preventDefault();
        var leadId = $('#declineLeadId').val();
        var message = $('#declineMessage').val();
        $.ajax({
            url: '/leads/' + leadId + '/decline',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                message: message
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('AJAX call failed:', error);
            }
        });
    });
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/manage_leads.blade.php ENDPATH**/ ?>