@extends('layouts.dealer')

@section('title', 'Add Cars')

@section('content')
<style>
    .hide{
        display: none;
    }

    .show{
        display: block;
    }
</style>
    <h1>Add Car</h1>
    <div class="card-body">
        <div id="confirmationMessage" class="alert alert-success" style="display:none;"></div>
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
        <form id="categoryForm" action="{{ route('dealer.store.car') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="car_brand_id">Make</label>
                        <select class="form-control" id="car_brand_id" onchange="updateSelectInfoForModelToMatchMake()" name="car_brand_id" required>
                            <option value="">Select Make</option>
                            @foreach ($Makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="car_model_id">Model</label>
                        <select class="form-control" id="car_model_id" onchange="updateSelectInfoForVariantToMatchModels()" name="car_model_id" >
                            <option value="">Select Model Of The Car</option>
                        </select>
                        <button type="button" class="btn btn-primary" onclick="expandModelManual()">Cant Find What You looking For?</button>
                        <input type="text" class="form-control hide" id="model" name="model" placeholder="Enter the variant of the make selected" >
                    </div>

                    <div class="form-group">
                        <label for="model">Variant</label>
                        <select class="form-control" id="variant_id"  name="variant_id" >
                            <option value="">Select a Variant Of The Car Model Selected</option>
                        </select>
                        <button type="button" class="btn btn-primary" onclick="expandVariantManual()">Cant Find What You looking For?</button>

                        <input type="text" class="form-control hide" id="variant" name="variant" placeholder="Enter the variant of the model selected manually" >
                    </div>
                  
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select class="form-control" id="year" name="year" required>
                            <option value="">Select Year</option>
                            @for ($year = 1990; $year <= date('Y'); $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="mileage">Mileage</label>
                        <input type="number" class="form-control" id="mileage" name="mileage">
                    </div>
                    <div class="form-group">
                        <label for="fuel_type">Fuel Type</label>
                        <select class="form-control" id="fuel_type" name="fuel_type" required>
                            <option value="">Select Fuel Type</option>
                            @foreach ($categories->where('category_type', 'Fuel Type') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transmission">Transmission</label>
                        <select class="form-control" id="transmission" name="transmission" required>
                            <option value="">Select Transmission</option>
                            @foreach ($categories->where('category_type', 'Transmission') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body_type">Body Type</label>
                        <select class="form-control" id="body_type" name="body_type" required>
                            <option value="">Select Body Type</option>
                            @foreach ($categories->where('category_type', 'Body Type') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="car_condition">Condition</label>
                        <select class="form-control" id="car_condition" name="car_condition" required>
                            <option value="">Select car Condition</option>
                            @foreach ($categories->where('category_type', 'Condition') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <select class="form-control" id="color" name="color" onchange="toggleCustomColorInput()">
                            <option value="">Select Color</option>
                            <option value="White">White</option>
                            <option value="Black">Black</option>
                            <option value="Silver">Silver</option>
                            <option value="Gray">Gray</option>
                            <option value="Blue">Blue</option>
                            <option value="Red">Red</option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                            <option value="Orange">Orange</option>
                            <option value="Brown">Brown</option>
                            <option value="Purple">Purple</option>
                            <option value="Pink">Pink</option>
                            <option value="Gold">Gold</option>
                            <option value="Beige">Beige</option>
                            <option value="Maroon">Maroon</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="custom_color" name="custom_color" placeholder="Enter custom color" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label for="engine_size">Engine Size</label>
                        <select class="form-control" id="engine_size" name="engine_size" onchange="toggleCustomEngineSizeInput()">
                            <option value="">Select Engine Size</option>
                            @foreach ($categories->where('category_type', 'Engine Size') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="custom_engine_size" name="custom_engine_size" placeholder="Enter custom engine size" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
      function toggleCustomColorInput() {
    const colorSelect = document.getElementById('color');
    const customColorInput = document.getElementById('custom_color');
    if (colorSelect.value === 'Other') {
        customColorInput.style.display = 'block';
        customColorInput.required = true;
    } else {
        customColorInput.style.display = 'none';
        customColorInput.required = false;
    }
}

function toggleCustomEngineSizeInput() {
    const engineSizeSelect = document.getElementById('engine_size');
    const customEngineSizeInput = document.getElementById('custom_engine_size');
    if (engineSizeSelect.value === 'Other') {
        customEngineSizeInput.style.display = 'block';
        customEngineSizeInput.required = true;
    } else {
        customEngineSizeInput.style.display = 'none';
        customEngineSizeInput.required = false;
    }
}
/* 
document.addEventListener('DOMContentLoaded', function() {
    initializeForm();
}); */

function updateSelectInfoForModelToMatchMake(){
    const makeId = document.getElementById('car_brand_id').value;
    const modelSelect = document.getElementById('car_model_id');
    modelSelect.innerHTML = '<option value="">Select Model Of The Car</option>';
    var data=@json($Models);
            data.forEach(model => {
                if(model.car_brand_id==makeId){
                const option = document.createElement('option');
                option.value = model.id;
                option.textContent = model.name;
                modelSelect.appendChild(option);
                }
            });
     
}

function expandVariantManual(){



   var variantInput= document.getElementById('variant')

   if(variantInput.classList.contains('hide')){
    variantInput.classList.remove('hide');
    variantInput.classList.add('show');
   }else{
    variantInput.classList.add('hide');
    variantInput.classList.remove('show');
   }
    
}

function expandModelManual(){
   var modelInput= document.getElementById('model')

    if(modelInput.classList.contains('hide')){
     modelInput.classList.remove('hide');
     modelInput.classList.add('show');
    }else{
        modelInput.classList.add('hide');
        modelInput.classList.remove('show');
    }

}
    

function updateSelectInfoForVariantToMatchModels(){
    const modelId = document.getElementById('car_model_id').value;
    const variantSelect = document.getElementById('variant_id');
    variantSelect.innerHTML = '<option value="">Select a Variant Of The Car Model Selected</option>';
    var data=@json($Variants);
            data.forEach(variant => {
                if(variant.car_model_id==modelId){
                const option = document.createElement('option');
                option.value = variant.id;
                option.textContent = variant.name;
                variantSelect.appendChild(option);
                }
            });
}
    </script>
@endsection
