@extends('layout.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="icon ion-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="icons ion-ios-keypad"></i> {{ trans_choice('dashboard.components.components', 2) }}
        </span>
        > <small>{{ trans('dashboard.components.add.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                @if($component = Session::get('component'))
                <div class="alert alert-{{ $component->isValid() ? 'success' : 'danger' }}">
                    @if($component->isValid())
                        {{ sprintf("<strong>%s</strong> %s", trans('dashboard.notifications.awesome'), trans('dashboard.components.add.success')) }}
                    @else
                        {{ sprintf("<strong>%s</strong> %s", trans('dashboard.notifications.whoops'), trans('dashboard.components.add.failure').' '.$component->getErrors()) }}
                    @endif
                </div>
                @endif

                <form name="CreateComponentForm" class="form-vertical" role="form" action="/dashboard/components/add" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label for="component-name">{{ trans('forms.components.name') }}</label>
                            <input type="text" class="form-control" name="component[name]" id="component-name" required />
                        </div>
                        <div class="form-group">
                            <label for="component-status">{{ trans('forms.components.status') }}</label>
                            <select name="component[status]" class="form-control">
                                @foreach(trans('cachet.components.status') as $statusID => $status)
                                <option value="{{ $statusID }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('forms.components.description') }}</label>
                            <textarea name="component[description]" class="form-control" rows="5"></textarea>
                        </div>
                        @if($groups->count() > 0)
                        <div class="form-group">
                            <label>{{ trans('forms.components.group') }}</label>
                            <select name="component[group_id]" class="form-control">
                                <option selected></option>
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <hr />
                        <div class="form-group">
                            <label>{{ trans('forms.components.link') }}</label>
                            <input type="text" name="component[link]" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>{{ trans('forms.components.tags') }}</label>
                            <textarea name="component[tags]" class="form-control" rows="2"></textarea>
                            <span class="help-block">{{ trans('forms.components.tags-help') }}</span>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-success">{{ trans('forms.create') }}</button>
                    <a class="btn btn-default" href="{{ route('dashboard.components') }}">{{ trans('forms.cancel') }}</a>
                    <input type="hidden" name="component[user_id]" value="{{ Auth::user()->id }}" />
                </form>
            </div>
        </div>
    </div>
@stop
