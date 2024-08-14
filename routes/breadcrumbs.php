<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Departement;
use App\Models\Position;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Illuminate\Support\Facades\Auth;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('Dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Home > Deparement
Breadcrumbs::for('Departement', function (BreadcrumbTrail $trail) {
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push('Departement', route('admin.departement'));
    }
});

Breadcrumbs::for('Departement List', function (BreadcrumbTrail $trail) {
    $trail->parent('Departement');
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push('Departement List', route('admin.departement'));
    }
});

Breadcrumbs::for('Add Departement', function (BreadcrumbTrail $trail) {
    $trail->parent('Departement');
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push('Add Departement', route('admin.departement'));
    }
});

Breadcrumbs::for('Edit Departement', function (BreadcrumbTrail $trail) {
    $trail->parent('Departement');
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push('Edit Departement', route('admin.departement'));
    }
});

Breadcrumbs::for('Position List', function (BreadcrumbTrail $trail, Departement $departement) {
    $trail->parent('Departement');
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push($departement->name, route('admin.position',$departement->slug));
    }
});

Breadcrumbs::for('Add Position', function (BreadcrumbTrail $trail, Departement $departement) {
    $trail->parent('Position List' , $departement);
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push('Add Position', route('admin.dashboard'));
    }
});

Breadcrumbs::for('Edit', function (BreadcrumbTrail $trail, Position $position) {
    $trail->parent('Position List' , $position->departement);
    if (Auth::guard('staff')->user()->role_id == 1) {
        $trail->push($position->name, route('admin.dashboard'));
    }
});


