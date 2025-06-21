<div>
    <div class="form-group">
        <label for="department">Municipio</label>
        <select name="department" id="department" class="custom-select" wire:model.live="departmentId">
            <option value="">Seleccione</option>
            @foreach ($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
            
        </select>
    </div>
    
    <div class="form-group">
        <label for="city">Ciudad</label>
        <select name="city" id="city" class="custom-select" wire:model.live="cityId">
            <option value="">Seleccione</option>
            @foreach ($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
        @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="neighborhood">Barrio</label>
        <select name="neighborhood" id="neighborhood" class="custom-select" wire:model="neighborhoodId">
            <option value="">Seleccione</option>
            @foreach ($neighborhoods as $neighborhood)
                <option value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
        @endforeach
        </select>
    </div>
</div>
