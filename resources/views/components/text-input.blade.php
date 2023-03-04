@props(['disabled' => false,'required'=>false,'checked'=>false,'inputvalue'=>false])

<input {{ $inputvalue ? 'value='.$inputvalue.'' : '' }} {{ $checked ? 'checked' : '' }} {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}
{!! $attributes->merge(['class' => ($disabled ? 'cursor-not-allowed bg-gray-100 ': '').'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
