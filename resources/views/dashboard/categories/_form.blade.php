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
    <lable for="">Category Name</lable>
    <input type="text" name="name" @class([ 'form-control' , 'is-invalid'=> $errors->has('name')])
    value="{{old('name',$categories->name)}}">
    @error('name')
    <div class="invalid-feedback"> {{$message}} </div>
    @enderror
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
    <lable for=""> Description</lable>
    <textarea name="description" class="form-control">
            {{old('description',$categories->description) }}
        </textarea>
</div>
<div class="form group">
    <lable for="">Image</lable>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($categories->image)
    <img src="{{ asset('storage/' .$categories->image)}}" alt="" height="50">
    @endif
</div>

<div class="form group">
    <lable for="">Status</lable>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status',$categories->status)
            =='active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status',$categories->status) ==
            'archived')>
            <label class="form-check-label">
                Archived
            </label>
        </div>
    </div>
    <div class="form group">
        <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
    </div>
</div>