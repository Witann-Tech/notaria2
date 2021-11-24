@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
@endsection

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Modificar tipo de tramite</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/admin/tipos-de-tramites/' . $formality->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $formality->name) }}"
                                class="form-control">
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
                            <input type="text" class="form-control" name="description"
                                value="{{ old('description', $formality->description) }}">
                        </div>
                        @error('description')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
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
                                    @if ($formality->steps()->exists())
                                        @foreach ($formality->steps as $step)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="step_name[]" value="{{ $step->name }}" />
                                                    <input type="hidden" name="step_description[]"
                                                        value="{{ $step->description }}" />
                                                    @if ($step->documents()->exists())
                                                        <input type="hidden" name="step_documents[]"
                                                            value="{{ count($step->documents->pluck('document_id')) > 0 ? implode(',', $step->documents->pluck('document_id')->toArray()) : '' }}" />
                                                    @else
                                                        <input type="hidden" name="step_documents[]" value="" />
                                                    @endif
                                                    @if ($step->participants()->exists())
                                                        <input type="hidden" name="step_participants[]"
                                                            value="{{ count($step->participants->pluck('participant_id')) > 0 ? implode(',', $step->participants->pluck('participant_id')->toArray()) : '' }}" />
                                                    @else
                                                        <input type="hidden" name="step_participants[]" value="" />
                                                    @endif
                                                    <input type="hidden" name="step_days[]" value="{{ $step->days }}" />
                                                    <span>{{ $step->name }}</span>
                                                </td>
                                                <td>{{ $step->description }}</td>
                                                <td>{{ $step->days }}</td>
                                                <td>
                                                    <?php $docs = []; ?>
                                                    @foreach ($step->documents as $doc)
                                                        <?php array_push($docs, $doc->document->name)?>
                                                    @endforeach
                                                    {{ join(", ", $docs) }}
                                                </td>
                                                <td>
                                                    <?php $parts = []; ?>
                                                    @foreach ($step->participants as $part)
                                                        <?php array_push($parts, $part->participant->name)?>
                                                    @endforeach
                                                    {{ join(", ", $parts) }}
                                                </td>
                                                <td>
                                                    <i class="far fa-pencil fa-lg text-warning editRow"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Modificar"></i>
                                                    <i class="far fa-trash fa-lg text-danger deleteRow"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Eliminar"></i>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <div class="modal fade" id="newStepModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva etapa</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nombre de la etapa</label>
                                <input type="text" name="name_step" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" name="description_step" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Días limite</label>
                                <input type="number" name="days_step" class="form-control text-end">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Documentos requeridos</label>
                                <input type="hidden" name="documents_step">
                                <select name="" id="my-select" multiple="multiple" class="form-control">
                                    @foreach ($documents as $document)
                                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Participantes</label>
                                <input type="hidden" name="participants_step">
                                <select name="" id="my-select-p" multiple="multiple" class="form-control">
                                    @foreach ($participants as $participant)
                                        <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a class="btn btn-secondary btn-sm" onclick="hideModal('newStepModal')">
                        <i class="far fa-times mr-1"></i> Cancelar
                    </a>
                    <a class="btn btn-primary text-white btn-sm addStepRow">
                        <i class="far fa-check mr-1"></i>Agregar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editStepModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modificar etapa</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nombre de la etapa</label>
                                <input type="text" name="name_step_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" name="description_step_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Días limite</label>
                                <input type="number" name="days_step_edit" class="form-control text-end">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Documentos requeridos</label>
                                <input type="hidden" name="documents_step_edit">
                                <select name="" id="my-select-e" multiple="multiple" class="form-control">
                                    @foreach ($documents as $document)
                                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Participantes</label>
                                <input type="hidden" name="participants_step_edit">
                                <select name="" id="my-select-p-e" multiple="multiple" class="form-control">
                                    @foreach ($participants as $participant)
                                        <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a class="btn btn-secondary btn-sm" onclick="hideModal('editStepModal')">
                        <i class="far fa-times mr-1"></i> Cancelar
                    </a>
                    <a class="btn btn-primary text-white btn-sm updateStepRow">
                        <i class="far fa-check mr-1"></i>Actualizar</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <script>
        var activeRow;

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

        callTooltip = () => {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }

        callTooltip();

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
    </script>

@endsection
