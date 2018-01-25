@if ($errors->any())
    <div class="alert alert-danger">
        <h4>Please fix following errors</h4>
        {{ Html::ul($errors->all()) }}
    </div>
@endif