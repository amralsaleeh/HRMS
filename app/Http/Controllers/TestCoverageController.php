<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TestCoverageController extends Controller
{
    private const COVERAGE_DIR = 'build/coverage/html';

    /**
     * Serve the test coverage HTML report (admin only).
     * Handles index and all static assets (CSS, JS, HTML pages).
     * Redirects /test-coverage to /test-coverage/ so relative asset paths resolve correctly.
     */
    public function __invoke(Request $request, ?string $path = null): Response|BinaryFileResponse|RedirectResponse
    {
        $basePath = base_path(self::COVERAGE_DIR);

        if (! is_dir($basePath)) {
            abort(404, 'Coverage report not found. Run: composer coverage');
        }

        // Ensure index is served under a trailing slash so _css/, _js/, etc. resolve correctly
        if (($path === null || $path === '') && ! str_ends_with($request->getRequestUri(), '/')) {
            return redirect()->to(rtrim($request->url(), '/') . '/', 301);
        }

        $requestedPath = ($path === null || $path === '') ? 'index.html' : $path;
        $requestedPath = str_replace(['../', '..\\'], '', $requestedPath);
        $resolvedPath = realpath($basePath . DIRECTORY_SEPARATOR . $requestedPath);

        if ($resolvedPath === false || ! str_starts_with($resolvedPath, realpath($basePath))) {
            abort(404);
        }

        if (! is_file($resolvedPath)) {
            abort(404);
        }

        $mimeType = match (strtolower(pathinfo($resolvedPath, PATHINFO_EXTENSION))) {
            'html' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'svg' => 'image/svg+xml',
            'json' => 'application/json',
            default => 'application/octet-stream',
        };

        return response()->file($resolvedPath, [
            'Content-Type' => $mimeType,
        ]);
    }
}
