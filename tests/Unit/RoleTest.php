<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * Check if a new role can be created
     * @test
     */
    public function check_if_new_role_can_be_created(): void
    {
        $role = \App\Models\Role::create(['title' => 'Admin']);

        $this->assertEquals(1, $role->id);
        $this->assertEquals('Admin', $role->title);
    }

    /**
     * Verify that a role has a many-to-many relationship with permissions
     * @test
     */
    public function verify_if_role_has_permissions_relationship(): void
    {
        $role = \App\Models\Role::create(['title' => 'Admin']);
        $permission = \App\Models\Permission::create(['title' => 'user_access']);

        $role->permissions()->attach($permission->id);

        $this->assertEquals('user_access', $role->permissions->first()->title);
    }

    /**
     * Verify that multiple permissions can be synced to a role
     * @test
     */
    public function verify_if_multiple_permissions_can_be_synced_to_role(): void
    {
        $role = \App\Models\Role::create(['title' => 'Admin']);
        $permissionA = \App\Models\Permission::create(['title' => 'user_access']);
        $permissionB = \App\Models\Permission::create(['title' => 'session_access']);

        $role->permissions()->sync([$permissionA->id, $permissionB->id]);

        $this->assertCount(2, $role->permissions);
    }

    /**
     * Verify that a role has a many-to-many relationship with users
     * @test
     */
    public function verify_if_role_has_users_relationship(): void
    {
        $user = \App\Models\User::factory()->create();
        $role = \App\Models\Role::create(['title' => 'Admin']);

        $role->users()->attach($user->id);

        $this->assertEquals($user->email, $role->users->first()->email);
    }
}
