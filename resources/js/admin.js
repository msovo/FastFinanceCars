// admin.js - Core administrative functionality
const Admin = {
    init: function() {
        this.initializeGlobalListeners();
        this.initializeTooltips();
        this.initializeDropdowns();
        this.setupAjaxDefaults();
    },

    initializeGlobalListeners: function() {
        // Global ajax loading indicator
        $(document).on({
            ajaxStart: function() { 
                $('#loadingIndicator').show();
            },
            ajaxStop: function() { 
                $('#loadingIndicator').hide();
            }
        });

        // Global error handler
        $(document).ajaxError(function(event, jqXHR, settings, error) {
            toastr.error('An error occurred while processing your request');
            console.error('Ajax Error:', error);
        });
    },

    initializeTooltips: function() {
        $('[data-toggle="tooltip"]').tooltip();
    },

    initializeDropdowns: function() {
        $('.dropdown-toggle').dropdown();
    },

    setupAjaxDefaults: function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },

    // Utility functions
    formatCurrency: function(amount) {
        return 'R' + amount.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    },

    formatNumber: function(number) {
        return number.toLocaleString();
    },

    formatDate: function(date) {
        return moment(date).format('DD MMM YYYY');
    },

    showLoading: function() {
        $('#loadingIndicator').show();
    },

    hideLoading: function() {
        $('#loadingIndicator').hide();
    },

    showSuccess: function(message) {
        toastr.success(message);
    },

    showError: function(message) {
        toastr.error(message);
    },

    confirm: function(message, callback) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }
};

// Initialize when document is ready
$(document).ready(function() {
    Admin.init();
});