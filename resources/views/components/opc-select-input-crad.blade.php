
<div class="w-full p-3 text-sm">

    <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}" />

    @if($list)
        <x-selected  id="{{$name}}" name="{{$name}}" :items="$customFunction($name)" :required="$required" :select="$values[$name]"/>
    @else

        <x-text-input id="{{$name}}" class="block mt-1 w-full" type="text" name="{{$name}}" :required="$required" value="{{strtoupper($values[$name])}}"  />
    @endif


    <x-input-error :messages="$errors->get($name)" class="mt-2" />


</div>
