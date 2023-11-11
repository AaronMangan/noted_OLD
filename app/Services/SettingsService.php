<?php

namespace App\Services;

use App\Models\User;
use App\Models\Page;
use Illuminate\Support\Arr;

class SettingsService
{
    /**
     * The page the settings belong to.
     *
     * @var instanceof Page
     */
    protected $page = null;

    /**
     * The settings.
     *
     * @var array
     */
    protected $settings = [];

    public const KEYS = ['private', 'shared_with_users'];

    /**
     * Constructor.
     *
     * @param Page $page
     * @param array $settings
     */
    public function __construct(Page $page, ?array $settings = [])
    {
        $this->page = $page;
        $this->settings = $settings;
    }

    public function update(): bool
    {
        return $this->page->update($this->settings);
    }

    public function setSharedWithUsers(array $emails = []): self
    {
        if(empty($emails) || !is_array($emails) || count($emails) < 1) {
            return $this;
        }

        // Get users.
        $users = User::findBy('email', $emails)->pluck('id')->toArray() ?? [];

        // Removes the page owner if they added themselves.
        Arr::pull($users, \Auth::user()->id);

        // Set and return.
        $this->settings['shared_with_users'] = array_filter(array_unique($users));
        return $this;
    }

    public function setPrivate(bool $value): self
    {
        $this->settings['private'] = $value;
        return $this;
    }
}
