@if($errors->any())
<div class="alert alert-danger">
    <h3> Error Occured !</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="form group">
    <x-form.input label="category Name" name="name" :value="$categories->name"/>
</div>

<div class="form group">
    <lable for="">Category Parent</lable>
    <select name="parent_id" class="form-control  form-select">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected(old('parent_id',$categories->parent_id) == $parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
</div>
<div class="form group">
    <x-form.textarea  label="Description" name="description" :value="$categories->description"/>
</div>
<div class="form group">
    <x-form.label id="image">Image</x-form.label>
    <input type="file" name="image" class="form-control" accept="image/*" />
    @if($categories->image)
    <img src="{{ asset('storage/' .$categories->image)}}" alt="" height="50">
    @endif
</div>

<div class="form group">
    <lable for="">Status</lable>
    <div>
       <x-form.radio name="status" :checked="$categories->status" :options="['active'=>'Active','archived'=>'Archived']"/>
        </div>
    </div>
    <div class="form group">
        <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
    </div>
</div>