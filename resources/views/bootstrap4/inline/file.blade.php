<div class="form-group">
    {!! \Laraflow\Form\Facades\Form::label($name, $label, $required, ['class' => 'sr-only d-none']) !!}
    @php
        $options = ['class' => 'form-control custom-file-input '];
        
        if (isset($required) && $required == true) {
            $options['required'] = 'required';
        }
    @endphp
    <div class="custom-file">
        {!! \Laraflow\Form\Facades\Form::label('', 'Choose file...', false, [
            'class' => 'custom-file-label',
            'id' => $name . '_file_label',
        ]) !!}
        {!! \Laraflow\Form\Facades\Form::file($name, $required, $attributes) !!}
        {!! \Laraflow\Form\Facades\Form::error($name) !!}
    </div>
    <script>
        document.getElementById('{{ $name }}').addEventListener('change', function() {
            var field = document.getElementById('{{ $name . '_file_label' }}');
            field.classList.add("selected");
            field.innerHTML = this.value.split("\\").pop();
        });
    </script>
</div>
