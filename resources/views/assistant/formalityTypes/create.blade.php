@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
@endsection

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Nuevo tipo de tramite</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/admin/tipos-de-tramites') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        </div>
                        @error('description')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <!--<div class="row mt-3">
                    <div class="col-12 col-sm-10">
                        <h5>Lista de etapas</h5>
                    </div>
                    <div class="col-12 col-sm-2 text-end">
                        <a class="btn btn-primary addStep text-white btn-sm"><i class="far fa-plus me-1"></i> Agregar
                            etapa</a>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-step">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Días limite</th>
                                        <th>Documentos</th>
                                        <th>Participantes</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>-->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <a href="{{ url('/admin/tipos-de-tramites') }}" class="btn btn-secondary"><i
                                class="far fa-times me-2"></i>Cancelar</a>
                        <button class="btn btn-primary text-white"><i class="far fa-check me-2"></i>Guardar</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
    
@endsection


@section('scripts')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <script>
        var activeRow;

        var documentsSelect = '<select class="form-control" multiple/>';

        @foreach ($documents as $document)
          documentsSelect += '<option value="{{ $document->id }}">{{ $document->name }}</option>'
        @endforeach
        
        documentsSelect += '</select>'

        document.querySelector('.addStep').addEventListener('click', (e) => {
            showModal('newStepModal')

            setTimeout(() => {
                $('#my-select').change(function() {
                    document.querySelector('[name="documents_step"]').value = $(this).val().join(
                        ',')
                }).multipleSelect({
                    filter: true
                });

                $('#my-select-p').change(function() {
                    document.querySelector('[name="participants_step"]').value = $(this).val().join(
                        ',')
                }).multipleSelect({
                    filter: true
                });

            }, 500);
        })

        document.querySelector('.addStepRow').addEventListener('click', () => {

            document.querySelectorAll('#newStepModal .invalid-feedback').forEach((item) => {
                item.remove()
            })

            var valid = true;

            if (!document.querySelector('[name="name_step"]').value) {
                document.querySelector('[name="name_step"]').insertAdjacentHTML('afterend',
                    '<div class="invalid-feedback d-block">Este campo es requerido</div>');
                valid = false;
            }

            if (!document.querySelector('[name="description_step"]').value) {
                document.querySelector('[name="description_step"]').insertAdjacentHTML('afterend',
                    '<div class="invalid-feedback d-block">Este campo es requerido</div>');
                valid = false;
            }

            if (!document.querySelector('[name="days_step"]').value) {
                document.querySelector('[name="days_step"]').insertAdjacentHTML('afterend',
                    '<div class="invalid-feedback d-block">Este campo es requerido</div>');
                valid = false;
            }

            if (!valid)
                return false;

            document.querySelector('.table-step').insertAdjacentHTML('beforeend',
                `<tr>
                    <td>
                        <input type="hidden" name="step_name[]" value="${document.querySelector('[name="name_step"]').value}"/>
                        <input type="hidden" name="step_description[]" value="${document.querySelector('[name="description_step"]').value}"/>
                        <input type="hidden" name="step_documents[]" value="${document.querySelector('[name="documents_step"]').value}"/>
                        <input type="hidden" name="step_participants[]" value="${document.querySelector('[name="participants_step"]').value}"/>
                        <input type="hidden" name="step_days[]" value="${document.querySelector('[name="days_step"]').value}"/>
                        <span>${document.querySelector('[name="name_step"]').value}</span></td>
                        <td>${document.querySelector('[name="description_step"]').value}</td>
                        <td>${document.querySelector('[name="days_step"]').value}</td>
                        <td>${document.querySelector('[name="documents_step"]').value}</td>
                        <td>${document.querySelector('[name="participants_step"]').value}</td>
                        <td>
                            <i class="far fa-pencil fa-lg text-warning editRow" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"></i>
                            <i class="far fa-trash fa-lg text-danger deleteRow" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i>
                        </td>
                        </tr>`
            )

            hideModal('newStepModal')

            callTooltip();

            document.querySelector('[name="name_step"]').value = '';
            document.querySelector('[name="description_step"]').value = '';
            document.querySelector('[name="days_step"]').value = '';

            document.querySelectorAll('.editRow').forEach((row) => {
                row.addEventListener('click', async () => {
                    activeRow = row.parentNode.parentNode
                    document.querySelector('input[name="name_step_edit"]').value = row
                        .parentNode.parentNode.querySelector('[name="step_name[]"]').value
                    document.querySelector('input[name="description_step_edit"]').value = row
                        .parentNode.parentNode.querySelector('[name="step_description[]"]')
                        .value
                    document.querySelector('input[name="days_step_edit"]').value = row
                        .parentNode.parentNode.querySelector('[name="step_days[]"]').value

                    var docs = row.parentNode.parentNode.querySelector(
                        'input[name="step_documents[]"]').value.split(',')
                    var parts = row.parentNode.parentNode.querySelector(
                        'input[name="step_participants[]"]').value.split(',')


                    Array.from(document.querySelector("#my-select-e").children).forEach((
                        option) => {
                        if (docs.includes(option.value))
                            option.setAttribute('selected', 'selected')
                    })

                    Array.from(document.querySelector("#my-select-p-e").children).forEach((
                        option) => {
                        if (parts.includes(option.value))
                            option.setAttribute('selected', 'selected')
                    })

                    $('#my-select-e').change(function() {
                        document.querySelector('[name="documents_step_edit"]').value =
                            $(this).val().join(
                                ',')
                    }).multipleSelect({
                        filter: true
                    });

                    $('#my-select-p-e').change(function() {
                        document.querySelector('[name="participants_step_edit"]')
                            .value = $(this).val().join(
                                ',')
                    }).multipleSelect({
                        filter: true
                    });

                    showModal('editStepModal')
                })
            })

            document.querySelectorAll('.deleteRow').forEach((row) => {
                row.addEventListener('click', async () => {
                    row.parentElement.parentElement.remove();
                })
            })
        })

        document.querySelector('.updateStepRow').addEventListener('click', () => {

            document.querySelectorAll('#editStepModal .invalid-feedback').forEach((item) => {
                item.remove()
            })

            var valid = true;

            if (!document.querySelector('[name="name_step_edit"]').value) {
                document.querySelector('[name="name_step_edit"]').insertAdjacentHTML('afterend',
                    '<div class="invalid-feedback d-block">Este campo es requerido</div>');
                valid = false;
            }

            if (!document.querySelector('[name="description_step_edit"]').value) {
                document.querySelector('[name="description_step_edit"]').insertAdjacentHTML('afterend',
                    '<div class="invalid-feedback d-block">Este campo es requerido</div>');
                valid = false;
            }

            if (!document.querySelector('[name="days_step_edit"]').value) {
                document.querySelector('[name="days_step_edit"]').insertAdjacentHTML('afterend',
                    '<div class="invalid-feedback d-block">Este campo es requerido</div>');
                valid = false;
            }

            if (!valid)
                return false;

            activeRow.querySelector('[name="step_name[]"]').value = document.querySelector(
                '[name="name_step_edit"]').value
            activeRow.querySelector('[name="step_description[]"]').value = document.querySelector(
                '[name="description_step_edit"]').value
            activeRow.querySelector('[name="step_days[]"]').value = document.querySelector(
                '[name="days_step_edit"]').value
            activeRow.querySelector('[name="step_documents[]"]').value = document.querySelector(
                '[name="documents_step_edit"]').value
            activeRow.querySelector('[name="step_participants[]"]').value = document.querySelector(
                '[name="participants_step_edit"]').value

            activeRow.querySelector('span').innerHTML = document.querySelector('[name="name_step_edit"]').value
            activeRow.querySelector('td:nth-child(2)').innerHTML = document.querySelector(
                '[name="description_step_edit"]').value
            activeRow.querySelector('td:nth-child(3)').innerHTML = document.querySelector('[name="days_step_edit"]')
                .value
            activeRow.querySelector('td:nth-child(4)').innerHTML = document.querySelector(
                '[name="documents_step_edit"]').value
            activeRow.querySelector('td:nth-child(5)').innerHTML = document.querySelector(
                '[name="participants_step_edit"]').value


            hideModal('editStepModal')

            document.querySelector('[name="name_step"]').value = '';
            document.querySelector('[name="description_step"]')
                .value = '';
            document.querySelector('[name="days_step"]').value = '';

        })

        document.querySelector('.addParticipant').addEventListener('click', async () => {

            document.querySelector('.participantsTable tbody').insertAdjacentHTML('beforeend',
                `<tr><td><input type="text" name="participant_name[]" class="form-control" /></td><td style="max-width: 200px;"><input type="hidden" name="participant_documents[]" />${documentsSelect}</td><td class="text-center align-middle"><i class="far fa-pencil fa-lg me-4 "></i><i class="far fa-trash text-danger fa-lg"></i></td></tr>`
                )
            let last = $(`.table tbody tr`).length

            $(`.table tbody tr:eq(${last-1}) select`).change(function() {
                $(`.table tbody tr:eq(${last-1}) [name="participant_documents[]"]`).val($(this).val()
                    .join(','))
            }).multipleSelect({
                filter: true
            });

        })



        callTooltip = () => {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }
    </script>

@endsection
