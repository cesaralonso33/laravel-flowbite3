
<div class="w-full p-3 text-sm">


    @switch($type)

            @case("TEXT")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required"/>

            <x-text-input
                id="{{$name}}"
                class="block mt-1 w-full"
                type="text"
                name="{{$name}}"
                :required="$required"
                :inputvalue="strtoupper($values[$name])"
                />

            @break

            @case("INT")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
            <x-text-input id="{{$name}}" class="block mt-1 w-full" type="number" name="{{$name}}" :required="$required"  :inputvalue="strtoupper($values[$name])"  />

            @break

            @case("BOOLEAN")
            <x-toggle-crad id="{{$name}}" :name="$name" :required="$required" :checked="$values[$name]" :type="$type" :labelc="$label"/>

            @break

            @case("DECIMAL")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required"/>
            <x-text-input id="{{$name}}" class="block mt-1 w-full" type="number"  step="0.01" name="{{$name}}" :required="$required" :inputvalue="strtoupper($values[$name])"  />

            @break



            @case("DATE")
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
              <x-text-input id="{{$name}}" class="block mt-1 w-full" type="date"    name="{{$name}}" :required="$required" :inputvalue="strtoupper($values[$name])"  />

            @break


            @case("LIST")
            @if($list)
            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required" />
            <x-selected  id="{{$name}}" name="{{$name}}" :items="$customFunction($name)" :required="$required" :select="$values[$name]"/>
            @endif
            @break

            @case("JSON")

            @break

            @case("IMAGE")



                {!! (Cache::get($values['id'])) !!}

            <x-input-label class="text-sm" for="{{$name}}" value="{{strtoupper($label)}}"   :required="$required"/>
            <x-text-input    multiple  id="{{$name}}"   type="file"   name="files[]"   :required="$required"   />



            @break
            @case("LONGTEXT")
            <x-textarea-crad id="{{$name}}" name="{{$name}}" :required="$required"  :value="strtoupper($values[$name])"  :labelc="$label"/>

            @break
        @default

    @endswitch


     <x-input-error :messages="$errors->get($name)" class="mt-2" />



</div>
