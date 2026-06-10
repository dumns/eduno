import preset from './vendor/filament/support/tailwind.config.preset'
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { zappicon } from '@zappicon/tailwind';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './app/Livewire/**/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    DEFAULT: '#0595CF',
                    hover: '#047AB5',
                    light: '#E0F4FE',
                    dark: '#0369A1',
                },
                secondary: {
                    DEFAULT: '#0EA5E9',
                    hover: '#0284C7',
                    light: '#E0F2FE',
                },
                success: {
                    DEFAULT: '#22C55E',
                    hover: '#16A34A',
                    light: '#DCFCE7',
                },
                danger: {
                    DEFAULT: '#EF4444',
                    hover: '#DC2626',
                    light: '#FEE2E2',
                },
                warning: {
                    DEFAULT: '#F59E0B',
                    hover: '#D97706',
                    light: '#FEF3C7',
                },
                info: {
                    DEFAULT: '#3B82F6',
                    hover: '#2563EB',
                    light: '#DBEAFE',
                },
                foreground: {
                    DEFAULT: '#0F172A',
                    dark: '#F1F5F9',
                },
                background: {
                    DEFAULT: '#FFFFFF',
                    dark: '#0F172A',
                },
                surface: {
                    DEFAULT: '#F8FAFC',
                    dark: '#1E293B',
                },
                muted: {
                    DEFAULT: '#64748B',
                    dark: '#94A3B8',
                },
                border: {
                    DEFAULT: '#E2E8F0',
                    dark: '#334155',
                },
            },

            spacing: {
                'ui-xs': '0.25rem',
                'ui-sm': '0.5rem',
                'ui-md': '1rem',
                'ui-lg': '1.5rem',
                'ui-xl': '2rem',
                'ui-2xl': '3rem',
                'ui-3xl': '4rem',
                'ui-4xl': '6rem',
            },

            borderRadius: {
                'ui-sm': '0.25rem',
                'ui-md': '0.375rem',
                'ui-lg': '0.5rem',
                'ui-xl': '0.75rem',
                'ui-2xl': '1rem',
            },

            fontSize: {
                'ui-xs': ['0.75rem', { lineHeight: '1rem' }],
                'ui-sm': ['0.875rem', { lineHeight: '1.25rem' }],
                'ui-base': ['1rem', { lineHeight: '1.5rem' }],
                'ui-lg': ['1.125rem', { lineHeight: '1.75rem' }],
                'ui-xl': ['1.25rem', { lineHeight: '1.75rem' }],
                'ui-2xl': ['1.5rem', { lineHeight: '2rem' }],
                'ui-3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                'ui-4xl': ['2.25rem', { lineHeight: '2.5rem' }],
            },

            boxShadow: {
                'ui-sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'ui-md': '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                'ui-lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
                'ui-xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                'ui-2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
            },

            transitionDuration: {
                'ui-fast': '150ms',
                'ui-normal': '250ms',
                'ui-slow': '350ms',
            },
        },
    },

    safelist: [
        // Ikon Zappicon yang dipanggil via x-ui:icon component (dynamic concat)
        'za-search-duotone',
        'za-plus-duotone',
        'za-check-circle-duotone',
        'za-angle-up-small-duotone',
        'za-angle-left-small-duotone',
        'za-angle-right-small-duotone',
        'za-bell-duotone',
        'za-filter-duotone',
        'za-info-circle-duotone',
        'za-clock-duotone',
        'za-star-duotone',
        'za-play-duotone',
        'za-arrow-right-small-duotone',
        'za-list-duotone',
        'za-exclamation-triangle-duotone',
        'za-xmark-circle-duotone',
        'za-exclamation-circle-duotone',
        'za-book-simple-duotone',
        'za-pen-line-duotone',
        'za-trash-duotone',
        'za-eye-duotone',
        'za-eye-slash-duotone',
        'za-envelope-duotone',
        'za-lock-simple-duotone',
        'za-gear-duotone',
        'za-download-bracket-duotone',
        'za-upload-bracket-duotone',
        'za-sort-duotone',
        'za-link-simple-duotone',
        'za-house-duotone',
        'za-heart-simple-duotone',
        'za-copy-duotone',
        'za-credit-card-duotone',
        'za-code-duotone',
        'za-flask-duotone',
        'za-arrows-rotate-duotone',
        'za-image-duotone',
        'za-camera-duotone',
        'za-file-text-duotone',
        'za-chat-dots-duotone',
        'za-compass-duotone',
        'za-life-ring-duotone',
        'za-share-duotone',
        'za-angle-down-small-duotone',
        'za-file-text-duotone',
        'za-check-list-duotone',
        'za-user-duotone',
        'za-calendar-duotone',
        'za-users-duotone',
        'za-book-simple-duotone',
    ],

    plugins: [forms, zappicon({ prefix: 'za', size: '1em', color: 'currentColor' })],
};
