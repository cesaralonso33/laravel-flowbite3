
<div class="w-full p-3 text-sm">


    @if($list)
    <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}" />
    <x-selected  id="{{$name}}" name="{{$name}}" :items="$customFunction($name)" :required="$required" :select="$values[$name]"/>

    @endif

    @if($type==="TEXT")
         <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}" />
        <x-text-input id="{{$name}}" class="block mt-1 w-full" type="text" name="{{$name}}" :required="$required" value="{{strtoupper($values[$name])}}"  />
     @endif

     @if($type==="INT")
     <x-toggle-crad id="{{$name}}" :name="$name" :required="$required" :checked="$values[$name]" :type="$type" :labelc="$label"/>
     @endif


     @if($type==="LONGTEXT")
     <x-textarea-crad id="{{$name}}" name="{{$name}}" :required="$required"  :value="strtoupper($values[$name])"  :labelc="$label"/>
     @endif

    <x-input-error :messages="$errors->get($name)" class="mt-2" />


</div>
