@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
@endsection

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Etapas del tramite</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/admin/tipos-de-tramites') }}" method="POST">
                @csrf
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
                                        <th>Participantes</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formality->steps as $step)
                                        <tr>
                                            <td>{{ $step->name }}</td>
                                            <td>{{ $step->description }}</td>
                                            <td>{{ $step->days }}</td>
                                            <td>{{ join(', ', $step->participants->pluck('name')->toArray()) }}</td>
                                            <td>
                                                <a><i class="far fa-pencil fa-lg editRow"
                                                        data-id="{{ $step->id }}"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva etapa</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre de la etapa</label>
                                <input type="text" name="name_step" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" name="description_step" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Días limite</label>
                                <input type="number" name="days_step" class="form-control text-end">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between">
                                            <h5 class="m-0">Participantes</h5>
                                            <a class="btn btn-primary text-white addParticipant"><i
                                                    class="far fa-plus me-2"></i> Agregar</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="table participantsTable">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Documentos</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
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
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modificar etapa</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre de la etapa</label>
                                <input type="text" name="name_step_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" name="description_step_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Días limite</label>
                                <input type="number" name="days_step_edit" class="form-control text-end">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between">
                                            <h5 class="m-0">Participantes</h5>
                                            <a class="btn btn-primary text-white addParticipantEdit"><i
                                                    class="far fa-plus me-2"></i> Agregar</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="table participantsTable">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Documentos</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a class="btn btn-secondary btn-sm" onclick="hideModal('newStepModal')">
                        <i class="far fa-times mr-1"></i> Cancelar
                    </a>
                    <a class="btn btn-primary text-white btn-sm updateStepRow">
                        <i class="far fa-check mr-1"></i>Agregar</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <script>
        var activeRow;
        var stepId = 0;

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

        document.querySelector('.addStepRow').addEventListener('click', async () => {

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

            var participants = []
            var documents = []

            document.querySelectorAll('[name="participant_name[]"]').forEach((row) => {
                participants.push(row.value)
            })

            document.querySelectorAll('[name="participant_documents[]"]').forEach((row) => {
                documents.push(row.value)
            })

            const res = await postCall(
                "{{ url('admin/tipos-de-tramites/' . $formality->id . '/etapas') }}", {
                    name: document.querySelector('[name="name_step"]').value,
                    description: document.querySelector('[name="description_step"]').value,
                    limit_days: document.querySelector('[name="days_step"]').value,
                    participants: participants,
                    documents: documents
                },
                "{{ csrf_token() }}");
            console.log(res)

            switch (res.status) {
                case 200:
                    var data = await res.json()
                    window.location.reload();
                    break;

                default:
                    break;
            }
        })

        buildSelect = (selected) => {
            var ids = [];
            selected.forEach((elem) => {
                ids.push(elem.document_id)
            })
            var sel = '<select class="form-control" multiple/>';

            @foreach ($documents as $document)
                console.log(ids)
                if(ids.indexOf(parseInt("{{ $document->id }}")) >= 0)
                sel += '<option value="{{ $document->id }}" selected>{{ $document->name }}</option>'
                else
                sel += '<option value="{{ $document->id }}">{{ $document->name }}</option>'
            @endforeach

            sel += '</select>'
            return sel;
        }

        document.querySelectorAll('.editRow').forEach((row) => {
            row.addEventListener('click', async () => {
                stepId = row.getAttribute('data-id')

                const res = await getCall(
                    "{{ url('admin/tipos-de-tramites/' . $formality->id . '/etapas') }}/" +
                    stepId, {}, "{{ csrf_token() }}");

                switch (res.status) {
                    case 200:
                        let data = await res.json();
                        document.querySelector('[name="name_step_edit"]').value = data.step.name
                        document.querySelector('[name="description_step_edit"]').value = data.step.name
                        document.querySelector('[name="days_step_edit"]').value = data.step.days

                        data.step.participants.forEach((item) => {
                            document.querySelector('#editStepModal .table tbody')
                                .insertAdjacentHTML('beforeend',
                                    `<tr><td><input type="text" name="participant_name[]" value="${item.name}" class="form-control" /></td><td style="max-width: 200px;"><input type="hidden" name="participant_documents[]" />${buildSelect(item.documents)}</td><td class="text-center align-middle"><i class="far fa-trash text-danger fa-lg"></i></td></tr>`
                                )

                            let last = $(`#editStepModal .table tbody tr`).length

                            $(`#editStepModal .table tbody tr:eq(${last-1}) select`).change(
                                function() {
                                    $(`#editStepModal .table tbody tr:eq(${last-1}) [name="participant_documents[]"]`)
                                        .val($(this).val()
                                            .join(','))
                                }).multipleSelect({
                                filter: true
                            });
                        })
                        break;

                    default:
                        break;
                }
                showModal('editStepModal')
            })
        })

        document.querySelector('.updateStepRow').addEventListener('click', async() => {

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

            var participants = []
            var documents = []

            document.querySelectorAll('[name="participant_name_edit[]"]').forEach((row) => {
                participants.push(row.value)
            })

            document.querySelectorAll('[name="participant_documents_edit[]"]').forEach((row) => {
                documents.push(row.value)
            })

            const res = await putCall(
                "{{ url('admin/tipos-de-tramites/' . $formality->id . '/etapas') }}/"+stepId, {
                    name: document.querySelector('[name="name_step_edit"]').value,
                    description: document.querySelector('[name="description_step_edit"]').value,
                    limit_days: document.querySelector('[name="days_step_edit"]').value,
                    participants: participants,
                    documents: documents
                },
                "{{ csrf_token() }}");
            console.log(res)

            switch (res.status) {
                case 200:
                    var data = await res.json()
                    window.location.reload();
                    break;

                default:
                    break;
            }

            /*activeRow.querySelector('[name="step_name[]"]').value = document.querySelector(
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
            document.querySelector('[name="days_step"]').value = '';*/

        })

        document.querySelector('.addParticipant').addEventListener('click', async () => {

            document.querySelector('.participantsTable tbody').insertAdjacentHTML('beforeend',
                `<tr><td><input type="text" name="participant_name[]" class="form-control" /></td><td style="max-width: 200px;"><input type="hidden" name="participant_documents[]" />${documentsSelect}</td><td class="text-center align-middle"><i class="far fa-trash text-danger fa-lg"></i></td></tr>`
            )
            let last = $(`.table tbody tr`).length

            $(`.table tbody tr:eq(${last-1}) select`).change(function() {
                $(`.table tbody tr:eq(${last-1}) [name="participant_documents[]"]`).val($(this).val()
                    .join(','))
            }).multipleSelect({
                filter: true
            });

        })

        document.querySelector('.addParticipantEdit').addEventListener('click', async () => {

            document.querySelector('#editStepModal .participantsTable tbody').insertAdjacentHTML('beforeend',
                `<tr><td><input type="text" name="participant_name_edit[]" class="form-control" /></td><td style="max-width: 200px;"><input type="hidden" name="participant_documents_edit[]" />${documentsSelect}</td><td class="text-center align-middle"><i class="far fa-trash text-danger fa-lg"></i></td></tr>`
            )
            let last = $(`#editStepModal .table tbody tr`).length

            $(`#editStepModal .table tbody tr:eq(${last-1}) select`).change(function() {
                $(`#editStepModal .table tbody tr:eq(${last-1}) [name="participant_documents_edit[]"]`).val($(this).val()
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
