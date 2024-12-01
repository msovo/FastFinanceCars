@extends('layouts.index')

@section('content')
<style>
/* General FAQ Section Styling */
.faq-section {
    width: 80%; /* Wider section for better visibility */
    margin: 40px auto; /* Center the section with padding */
    background-color: #ffffff; /* White background for clarity */
    padding: 30px; /* Add more space inside the container */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Add subtle shadow for depth */
}

/* Header Styling */
.faq-section h2 {
    color: #1e1e1e; /* Dark gray color for the title */
    font-size: 2rem; /* Larger title */
    font-weight: 600; /* Bold title */
    margin-bottom: 20px; /* Space below the title */
    text-align: center; /* Center align title */
}

/* Accordion Item Styling */
.faq-section .accordion-item {
    margin-bottom: 15px; /* Spacing between each item */
    border: none; /* Remove border around accordion items */
    border-radius: 8px; /* Rounded corners */
}

/* Accordion Button (Heading) Styling */
.faq-section .accordion-button {
    background-color: #007bff; /* Use a vibrant blue color */
    color: white; /* White text for contrast */
    font-weight: 500; /* Medium weight for readability */
    border-radius: 8px; /* Rounded corners */
    padding: 10px 15px; /* Padding for better click area */
    font-size: 1.1rem; /* Slightly larger text for readability */
    transition: background-color 0.3s ease; /* Smooth background color transition */
}

/* Hover Effect for Accordion Button */
.faq-section .accordion-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Accordion Button Active (Expanded) */
.faq-section .accordion-button:not(.collapsed) {
    background-color: #0056b3; /* Darker blue when expanded */
    color: white; /* White text when expanded */
}

/* Accordion Body Styling (Answer Content) */
.faq-section .accordion-body {
    background-color: #f8f9fa; /* Light gray background */
    color: #333; /* Darker text for the body */
    font-size: 1rem; /* Slightly smaller font size */
    padding: 20px 15px; /* Padding inside the body */
    border-top: 2px solid #007bff; /* Thin blue border at the top */
    border-radius: 0 0 8px 8px; /* Rounded bottom corners */
    transition: max-height 0.3s ease-out; /* Smooth collapse/expand animation */
}

/* Search Bar Styling */
.search-bar {
    width: 50%; /* Make the search bar more prominent */
    margin: 0 auto 30px auto; /* Center the search bar with space at the bottom */
    padding: 10px 15px; /* Padding inside the input */
    font-size: 1.1rem; /* Larger font for easy readability */
    border-radius: 8px; /* Rounded edges */
    border: 1px solid #ccc; /* Light border */
    transition: all 0.3s ease; /* Smooth transition on focus */
}

/* Focus Effect for Search Bar */
.search-bar:focus {
    border-color: #007bff; /* Highlight border on focus */
    outline: none; /* Remove default outline */
}

/* Styling for the Search Button (optional) */
.search-button {
    background-color: #007bff; /* Blue background for button */
    color: white; /* White text */
    font-size: 1rem; /* Medium text size */
    padding: 12px 20px; /* Padding inside button */
    border-radius: 8px; /* Rounded corners */
    border: none; /* Remove border */
    cursor: pointer; /* Pointer cursor */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}

/* Button Hover Effect */
.search-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Responsive Design for Mobile */
@media (max-width: 768px) {
    .faq-section {
        width: 95%; /* Make the FAQ section full width on smaller screens */
        padding: 20px;
    }
    .search-bar {
        width: 90%; /* Make the search bar larger on small screens */
    }
}

</style>

<div class="faq-section">
    <h2>Frequently Asked Questions</h2>
    
    <input type="text" id="faqSearch" class="form-control search-bar" placeholder="Search FAQs...">

    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How do I list my car for sale?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    To list your car for sale, create an account on our platform, navigate to the "Sell Your Car" section, and follow the prompts to enter your vehicle's details, upload photos, and set your asking price.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    What information do I need to provide to list my car?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You will need to provide the car's make, model, year, mileage, condition, and a detailed description. High-quality photos of the car are also required to attract potential buyers.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How do I get my car valued?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can get your car valued by filling out the "Get Your Car Valued" form on our platform. Provide details about your car, and our system will give you an estimated market value based on the current trends and the condition of the car.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    What is the process for purchasing a car?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Once you find a car you're interested in, you can contact the seller directly through the platform. You can negotiate the price, arrange payment, and handle all transactions securely through our system.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    How do I contact a seller?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can contact a seller directly through our platform by sending a message via the contact form on the vehicle's listing page. Alternatively, you can use the provided phone number if available.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    What should I look for when buying a used car?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    When buying a used car, check the vehicle's history report, inspect the car thoroughly, take it for a test drive, and consider having it inspected by a trusted mechanic. Look for signs of wear and tear, and verify the car's maintenance records.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    How do I schedule a test drive?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    To schedule a test drive, click the "Schedule Test Drive" button on the vehicle's listing page and choose a convenient date and time. The seller will confirm the appointment with you.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    What payment methods are accepted?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We accept various payment methods including bank transfers, financing through our partnered lenders, and secure online payments. Specific payment options will be detailed during the purchase process.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Is financing available?
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, we offer financing options through our trusted lending partners. You can apply for financing directly on our platform and get pre-approved before making a purchase.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    What should I do if I encounter a problem with my purchase?
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you encounter any issues with your purchase, please contact our customer support team immediately. We are here to assist you and ensure a smooth and satisfactory transaction.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    How do I upload pictures to my ad?
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Click the select photo button. Your saved photos on your device or computer will appear. Locate the photo you would like to upload. Once you select your photo, it will automatically upload. Ensure your images are in landscape orientation, have good lighting, and a pleasant background.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    How do I avoid fraud when selling my car?
                </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Always meet buyers in a public place, verify payment before handing over the keys, and be cautious of buyers who offer to pay more than the asking price or who are in a hurry to complete the transaction.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    How do I upload pictures to my ad?
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Click the select photo button. Your saved photos on your device or computer will appear. Locate the photo you would like to upload. Once you select your photo, it will automatically upload. Ensure your images are in landscape orientation, have good lighting, and a pleasant background.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    How do I avoid fraud when selling my car?
                </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Always meet buyers in a public place, verify payment before handing over the keys, and be cautious of buyers who offer to pay more than the asking price or who are in a hurry to complete the transaction.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEleven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                    How do I determine the right price for my car?
                </button>
            </h2>
            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can use our car valuation tool to find the market value of your car. Consider factors like the car's condition, mileage, and any additional features when setting your price.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwelve">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    Can I edit my listing after it's posted?
                </button>
            </h2>
            <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, you can edit your listing at any time by logging into your account and navigating to the "My Listings" section. From there, you can update the details, photos, and price of your car.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThirteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                    What should I do if I forget my password?
                </button>
            </h2>
            <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you forget your password, click the "Forgot Password" link on the login page. Enter your email address, and we will send you instructions on how to reset your password.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFourteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                    How do I delete my account?
                </button>
            </h2>
            <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    To delete your account, please contact our customer support team. They will assist you with the process and ensure that all your data is securely removed from our system.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFifteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                    How do I report a suspicious listing?
                </button>
            </h2>
            <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you come across a suspicious listing, click the "Report" button on the listing page. Provide as much detail as possible, and our team will investigate the issue promptly.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSixteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                    Can I get a refund if I'm not satisfied with my purchase?
                </button>
            </h2>
            <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Refund policies vary depending on the seller and the terms of the sale. Please review the seller's refund policy before making a purchase. If you encounter any issues, contact our customer support team for assistance.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeventeen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                    How do I leave a review for a seller?
                </button>
            </h2>
            <div id="collapseSeventeen" class="accordion-collapse collapse" aria-labelledby="headingSeventeen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    After completing a transaction, you can leave a review for the seller by navigating to the "My Purchases" section in your account. Click on the transaction and select "Leave a Review" to share your experience.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    How do I avoid fraud when selling my car?
                </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Always meet buyers in a public place, verify payment before handing over the keys, and be cautious of buyers who offer to pay more than the asking price or who are in a hurry to complete the transaction.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEleven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                    How do I determine the right price for my car?
                </button>
            </h2>
            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can use our car valuation tool to find the market value of your car. Consider factors like the car's condition, mileage, and any additional features when setting your price.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwelve">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    Can I edit my listing after it's posted?
                </button>
            </h2>
            <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, you can edit your listing at any time by logging into your account and navigating to the "My Listings" section. From there, you can update the details, photos, and price of your car.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThirteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                    What should I do if I forget my password?
                </button>
            </h2>
            <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you forget your password, click the "Forgot Password" link on the login page. Enter your email address, and we will send you instructions on how to reset your password.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFourteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                    How do I delete my account?
                </button>
            </h2>
            <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    To delete your account, please contact our customer support team. They will assist you with the process and ensure that all your data is securely removed from our system.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFifteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                    How do I report a suspicious listing?
                </button>
            </h2>
            <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you come across a suspicious listing, click the "Report" button on the listing page. Provide as much detail as possible, and our team will investigate the issue promptly.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSixteen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                    Can I get a refund if I'm not satisfied with my purchase?
                </button>
            </h2>
            <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Refund policies vary depending on the seller and the terms of the sale. Please review the seller's refund policy before making a purchase. If you encounter any issues, contact our customer support team for assistance.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeventeen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                    How do I leave a review for a seller?
                </button>
            </h2>
            <div id="collapseSeventeen" class="accordion-collapse collapse" aria-labelledby="headingSeventeen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    After completing a transaction, you can leave a review for the seller by navigating to the "My Purchases" section in your account. Click on the transaction and select "Leave a Review" to share your experience.
                </div>
            </div>
        </div>
    
    </div>
</div>

<script>
    document.getElementById('faqSearch').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const faqItems = document.querySelectorAll('.accordion-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.accordion-button').textContent.toLowerCase();
            const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

            if (question.includes(searchQuery) || answer.includes(searchQuery)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection
