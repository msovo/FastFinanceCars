@extends('layouts.index')

@section('content')

    <style>
        .accordion-button {
            background-color: whitesmoke;
            color: black !important;
            font-weight: 600;
            transition: background-color 0.3s ease;
            border:none;
            
        }
        .accordion-button:not(.collapsed) {
            background-color: #0056b3;
        }
        .accordion-button:hover {
            background-color: #0056b3;
        }
        .accordion-body img {
            max-width: 100%;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .accordion-item {
            border: 1px solid #007bff;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        .accordion-header {
            background-color: #e3f2fd;
            font-size: 1.2rem;
            font-weight: 500;
            padding: 15px;
            text-align:center;
        }
        .accordion-body {
            padding: 20px;
        }
        .accordion-button:focus {
            box-shadow: none;
        }

        .img-fluid{
            height: 250px;;
        }
    </style>
    <div class="container">
        <h1>The Car-Buying Journey: Exploring Your Options</h1>
        
        <div class="accordion" id="carBuyingAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Hold Off on Debt
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://images.pexels.com/photos/3752194/pexels-photo-3752194.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Hold Off on Debt" class="img-fluid rounded shadow-sm">
                        <p>If your current car is still safe and reliable, driving it for as long as possible can help you save money. This way, you can put down a larger deposit on your next car, reducing the amount you need to finance.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Assess Your Needs
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://automotiveblog.co.uk/wp-content/uploads/2017/08/car-finance-cost.jpg" alt="Assess Your Needs" class="img-fluid rounded shadow-sm">
                        <p>Understanding your requirements will guide you to a car that fits both your lifestyle and budget. Consider factors like whether you'll be driving kids around, mostly driving in town or on highways, and if you need space for sports gear. Remember, your car choice will also impact your insurance premiums. A practical, mid-range car will generally cost less to insure than a high-powered sports car.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        New vs. Used Cars
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://th.bing.com/th/id/R.ee1a6fa44c802dd5145ad86735d6262e?rik=lrFxZv%2fsSltqIA&pid=ImgRaw&r=0" alt="New vs. Used Cars" class="img-fluid rounded shadow-sm">
                        <p>You might be surprised at the number of reliable used cars available for the price of a new entry-level model. However, be cautious with older, high-end cars as they can be expensive to repair. A smart choice would be a low-mileage, late-model car that offers more features and comfort than a new, basic model. Demo models are also a great option as they have already depreciated but usually have low mileage.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Financing Options
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://www.motorera.com/wp-content/uploads/2019/08/d1849ce8c2baa84ec792b09eb9441975.jpeg" alt="Financing Options" class="img-fluid rounded shadow-sm">
                        <p>Once you've decided on the car you want, it's time to explore financing options. Whether you choose to buy from a dealer or a private seller, each has its pros and cons. Dealers often offer financing, while private sales might require a personal loan.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Paying with Cash
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://assets.carpages.ca/prod-blog/uploads/2021/09/shutterstock_1774970570-1.jpg" alt="Paying with Cash" class="img-fluid rounded shadow-sm">
                        <p>Paying cash for a car can save you from paying interest on a loan. However, dealerships might not accept large amounts of cash and may offer less room for negotiation if you're not financing through them. Agree on a price before transferring any funds.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Trade-In Considerations
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://th.bing.com/th/id/OIP.WaEnEZE-B53s1Td5495vdQHaEK?rs=1&pid=ImgDetMain" alt="Trade-In Considerations" class="img-fluid rounded shadow-sm">
                        <p>It's beneficial to have your current car fully paid off before trading it in. This can provide a better trade-in value, reducing the amount you need to finance for your new car.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        Balloon Payments
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://th.bing.com/th/id/OIP.4sxhbrWFTSloMj9MEwDPsQAAAA?rs=1&pid=ImgDetMain" alt="Balloon Payments" class="img-fluid rounded shadow-sm">
                        <p>Balloon payments can lower your monthly installments but require a large payment at the end of the loan term. This can be risky if you're not prepared for it, potentially leading to more debt.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        Leasing vs. Buying
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://blog.vancity.com/wp-content/uploads/2018/07/LeasevsFinanceInfographic-IAMT-Blog-1000x484.jpg" alt="Leasing vs. Buying" class="img-fluid rounded shadow-sm">
                        <p>Leasing a car means you pay for its use over a set period and return it at the end. This can be more affordable monthly but comes with usage limitations. It's a good option if you prefer lower payments and don't mind not owning the car.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        Guaranteed Future Value (GFV)
                    </button>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://i.ytimg.com/vi/bgjM4oO7kXI/maxresdefault.jpg" alt="Guaranteed Future Value (GFV)" class="img-fluid rounded shadow-sm">
                        <p>GFV plans, like Mercedes-Benz’s Agility Finance, offer a predetermined future value for your car, giving you options at the end of the term: trade it in, pay off the balance, or return it. Ensure you understand all terms and conditions before entering into a GFV plan to avoid surprises.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTen">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        Poor Credit History
                    </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://carttraction.com/wp-content/uploads/what-is-a-credit-score-scaled.jpg" alt="Poor Credit History" class="img-fluid rounded shadow-sm">
                        <p>If you have a low credit score, securing financing through a dealership might be challenging. Some dealerships offer in-house financing but often at higher interest rates and stricter terms. Consider consulting a financial advisor or improving your credit score before applying for financing.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEleven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                        Hidden Costs
                    </button>
                </h2>
                <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#carBuyingAccordion">
                    <div class="accordion-body">
                        <img src="https://cdn.gobankingrates.com/wp-content/uploads/2013/06/6_maxuser_shutterstock_230306026.jpg" alt="Hidden Costs" class="img-fluid rounded shadow-sm">
                        <p>Be aware of additional costs beyond the car's purchase price, such as dealership fees, fuel, and maintenance. Budgeting for these expenses is crucial to avoid financial surprises. Be sure to account for these when calculating the total cost of ownership.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


