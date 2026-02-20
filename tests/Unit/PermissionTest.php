<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * Check if a new permission can be created
     * @test
     */
    public function check_if_new_permission_can_be_created(): void
    {
        $permission = \App\Models\Permission::create(['title' => 'user_access']);

        $this->assertEquals(1, $permission->id);
        $this->assertEquals('user_access', $permission->title);
    }

    /**
     * Verify that a permission has a many-to-many relationship with roles
     * @test
     */
    public function verify_if_permission_has_roles_relationship(): void
    {
        $role = \App\Models\Role::create(['title' => 'Admin']);
        $permission = \App\Models\Permission::create(['title' => 'user_access']);

        $permission->roles()->attach($role->id);

        $this->assertEquals('Admin', $permission->roles->first()->title);
    }

    /**
     * Verify that multiple roles can be assigned the same permission
     * @test
     */
    public function verify_if_permission_can_be_shared_across_roles(): void
    {
        $roleA = \App\Models\Role::create(['title' => 'Admin']);
        $roleB = \App\Models\Role::create(['title' => 'Manager']);
        $permission = \App\Models\Permission::create(['title' => 'user_access']);

        $permission->roles()->sync([$roleA->id, $roleB->id]);

        $this->assertCount(2, $permission->roles);
    }
}
