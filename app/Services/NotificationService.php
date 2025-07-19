<?php

namespace App\Services;

class NotificationService {
    private static $createMessage = "Created Successfully.";
    private static $updateMessage = "Updated Successfully.";
    private static $deleteMessage = "Deleted Successfully.";
    private static $errorMessage = "Something went wrong.";

    static function CREATED($message = null) {
        notyf()->success($message ?? self::$createMessage);
    }

    static function UPDATED($message = null) {
        notyf()->success($message ?? self::$updateMessage);
    }

    static function DELETED($message = null) {
        notyf()->success($message ?? self::$deleteMessage);
    }

    static function ERROR($message = null) {
        notyf()->error($message ?? self::$errorMessage);   
    }

}
