@props(['name' => false, 'label' => false,'required'=>false, 'list'=>false])


<div class="w-full p-3">

    <x-input-label for="{{$name}}" value="{{$label}}" />
        <x-text-input id="{{$name}}" class="block mt-1 w-full" type="text" name="{{$name}}" :required="$required"   />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />

    </div>
