<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="reviewModalLabel">
                    <i class="fas fa-search"></i> Dealer Review
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="dealer-review-content">
                    <!-- Content will be loaded dynamically -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Verification Notes Modal -->
<div class="modal fade" id="verificationNotesModal" tabindex="-1" role="dialog" aria-labelledby="verificationNotesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="verificationNotesModalLabel">
                    <i class="fas fa-check-circle"></i> Verification Notes
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="verificationNotesForm">
                    <div class="form-group">
                        <label for="verificationNotes">Additional Notes</label>
                        <textarea class="form-control" id="verificationNotes" rows="4" 
                                  placeholder="Enter any additional notes about this verification..."></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sendNotification">
                            <label class="custom-control-label" for="sendNotification">
                                Send notification email to dealer
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-success" id="confirmVerification">
                    <i class="fas fa-check"></i> Confirm Verification
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-labelledby="rejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rejectionModalLabel">
                    <i class="fas fa-times-circle"></i> Reject Dealer
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rejectionForm">
                    <div class="form-group">
                        <label for="rejectionReason">Reason for Rejection</label>
                        <select class="form-control" id="rejectionReason">
                            <option value="">Select a reason...</option>
                            <option value="incomplete_documents">Incomplete Documents</option>
                            <option value="invalid_documents">Invalid Documents</option>
                            <option value="suspicious_activity">Suspicious Activity</option>
                            <option value="duplicate_account">Duplicate Account</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group" id="otherReasonGroup" style="display: none;">
                        <label for="otherReason">Specify Other Reason</label>
                        <textarea class="form-control" id="otherReason" rows="3" 
                                  placeholder="Please specify the reason for rejection..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rejectionNotes">Additional Notes</label>
                        <textarea class="form-control" id="rejectionNotes" rows="4" 
                                  placeholder="Enter any additional notes about this rejection..."></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sendRejectionNotification" checked>
                            <label class="custom-control-label" for="sendRejectionNotification">
                                Send rejection email to dealer
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmRejection">
                    <i class="fas fa-times-circle"></i> Confirm Rejection
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1" role="dialog" aria-labelledby="bulkActionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkActionModalLabel">
                    <i class="fas fa-users"></i> Bulk Action
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="selected-dealers-list mb-4">
                    <h6 class="font-weight-bold">Selected Dealers:</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Listings</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="selectedDealersList">
                                <!-- Will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <form id="bulkActionForm">
                    <div class="form-group">
                        <label for="bulkActionNotes">Notes</label>
                        <textarea class="form-control" id="bulkActionNotes" rows="4" 
                                  placeholder="Enter any notes about this bulk action..."></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sendBulkNotification" checked>
                            <label class="custom-control-label" for="sendBulkNotification">
                                Send notification emails
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-primary" id="confirmBulkAction">
                    <i class="fas fa-check"></i> Confirm Action
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h5 class="modal-title mb-3" id="successModalLabel">Action Completed Successfully</h5>
                <p class="text-muted" id="successMessage"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-check"></i> Done
                </button>
            </div>
        </div>
    </div>
</div>