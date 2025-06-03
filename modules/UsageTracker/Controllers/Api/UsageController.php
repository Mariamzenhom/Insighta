<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Controllers\Api;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\UsageTracker\Handlers\DeleteUsageTrackerHandler;
use Modules\UsageTracker\Handlers\UpdateUsageTrackerHandler;
use Modules\UsageTracker\Presenters\UsageTrackerPresenter;
use Modules\UsageTracker\Requests\Api\CreateUsageTrackerRequest;
use Modules\UsageTracker\Requests\Api\DeleteUsageTrackerRequest;
use Modules\UsageTracker\Requests\Api\GetUsageTrackerListRequest;
use Modules\UsageTracker\Requests\Api\GetUsageTrackerRequest;
use Modules\UsageTracker\Requests\Api\UpdateUsageTrackerRequest;
use Modules\UsageTracker\Services\UsageTrackerCRUDService;
use Modules\UsageTracker\Models\AppUsage;
use Ramsey\Uuid\Uuid;

class UsageController extends Controller
{
    public function track(Request $request)
    {
        $user = $request->user();
        $platform = $request->input('platform');
        $duration = $request->input('duration', 5); // دقيقة افتراضية

        $usage = AppUsage::firstOrNew([
            'user_id' => $user->id,
            'platform' => $platform,
            'date' => now()->toDateString(),
        ]);

        $usage->duration_minutes += $duration;
        $usage->save();

        return response()->json(['message' => 'Usage tracked']);
    }

    public function usageChart(Request $request)
    {
        $user = $request->user();

        $usages = AppUsage::where('user_id', $user->id)
            ->where('date', now()->toDateString())
            ->get(['platform', 'duration_minutes']);

        return response()->json($usages);
    }
}