@props(['value','required'=>false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }} @if($required) <re class="text-red-600 font-bold text-xl ">*</re> @endif
</label>
