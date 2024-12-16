<div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9;">
  <h4 style="color:rgb(216, 21, 21); font-size: 1.5em; margin-bottom: 10px;">Fast Finance Cars</h4>
  <p style="font-size: 1.1em; margin-bottom: 20px;">Dear {{$name}},</p>
  <p style="margin-bottom: 20px;">You have received a new inquiry from {{ $inquiry->name }}.</p>
  <p style="margin-bottom: 20px; font-style: italic;">Message: "{{ $inquiry->message }}"</p>
  <div style="text-align: center; margin-bottom: 20px;">
    <a href="{{ route('cars.show', $inquiry->listing_id) }}" style="background-color: #4CAF50; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 1em;">View Car</a>
  </div>
  <p style="margin-bottom: 20px;">Best regards,</p>
  <p style="font-weight: bold;">Your Dealership</p>
</div>
