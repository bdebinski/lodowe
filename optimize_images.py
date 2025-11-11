#!/usr/bin/env python3
"""
Skrypt do bezstratnej kompresji obrazów WebP i JPEG
Użycie: python3 optimize_images.py
Wymaga: pip install Pillow
"""
import os
from pathlib import Path
from PIL import Image

def get_file_size(filepath):
    """Zwraca rozmiar pliku w bajtach"""
    return os.path.getsize(filepath)

def optimize_webp(filepath):
    """Optymalizuje plik WebP bez utraty jakości"""
    original_size = get_file_size(filepath)
    try:
        img = Image.open(filepath)
        # lossless=True - kompresja bezstratna
        # method=6 - maksymalna kompresja (wolniejsze, ale lepsze)
        img.save(filepath, 'WEBP', lossless=True, quality=100, method=6)
        new_size = get_file_size(filepath)
        saved = original_size - new_size
        saved_percent = (saved / original_size * 100) if original_size > 0 else 0
        return {
            'success': True,
            'original_size': original_size,
            'new_size': new_size,
            'saved': saved,
            'saved_percent': saved_percent
        }
    except Exception as e:
        return {'success': False, 'error': str(e), 'original_size': original_size}

def optimize_jpeg(filepath):
    """Optymalizuje plik JPEG bez utraty jakości"""
    original_size = get_file_size(filepath)
    try:
        img = Image.open(filepath)
        # optimize=True - optymalizuje kodowanie bez utraty jakości
        img.save(filepath, 'JPEG', quality=100, optimize=True)
        new_size = get_file_size(filepath)
        saved = original_size - new_size
        saved_percent = (saved / original_size * 100) if original_size > 0 else 0
        return {
            'success': True,
            'original_size': original_size,
            'new_size': new_size,
            'saved': saved,
            'saved_percent': saved_percent
        }
    except Exception as e:
        return {'success': False, 'error': str(e), 'original_size': original_size}

def format_size(bytes_size):
    """Formatuje rozmiar w bajtach do czytelnej postaci"""
    for unit in ['B', 'KB', 'MB', 'GB']:
        if bytes_size < 1024.0:
            return f"{bytes_size:.2f} {unit}"
        bytes_size /= 1024.0
    return f"{bytes_size:.2f} TB"

def main():
    base_dir = Path('static/images')

    # Znajdź wszystkie pliki obrazów
    webp_files = list(base_dir.rglob('*.webp'))
    jpeg_files = list(base_dir.rglob('*.jpg')) + list(base_dir.rglob('*.jpeg'))

    total_files = len(webp_files) + len(jpeg_files)
    print(f"Znaleziono {len(webp_files)} plików WebP i {len(jpeg_files)} plików JPEG")
    print(f"Całkowita liczba plików do optymalizacji: {total_files}\n")

    total_original_size = 0
    total_new_size = 0
    successful = 0
    failed = 0

    # Optymalizuj pliki WebP
    print("Optymalizacja plików WebP...")
    for i, filepath in enumerate(webp_files, 1):
        print(f"[{i}/{len(webp_files)}] {filepath.name}...", end=' ', flush=True)
        result = optimize_webp(filepath)

        if result['success']:
            total_original_size += result['original_size']
            total_new_size += result['new_size']
            successful += 1
            if result['saved'] > 0:
                print(f"✓ Zapisano {format_size(result['saved'])} ({result['saved_percent']:.1f}%)")
            else:
                print(f"✓ Brak zmian")
        else:
            failed += 1
            print(f"✗ Błąd: {result['error']}")

    # Optymalizuj pliki JPEG
    if jpeg_files:
        print("\nOptymalizacja plików JPEG...")
        for i, filepath in enumerate(jpeg_files, 1):
            print(f"[{i}/{len(jpeg_files)}] {filepath.name}...", end=' ', flush=True)
            result = optimize_jpeg(filepath)

            if result['success']:
                total_original_size += result['original_size']
                total_new_size += result['new_size']
                successful += 1
                if result['saved'] > 0:
                    print(f"✓ Zapisano {format_size(result['saved'])} ({result['saved_percent']:.1f}%)")
                else:
                    print(f"✓ Brak zmian")
            else:
                failed += 1
                print(f"✗ Błąd: {result['error']}")

    # Podsumowanie
    total_saved = total_original_size - total_new_size
    total_saved_percent = (total_saved / total_original_size * 100) if total_original_size > 0 else 0

    print("\n" + "="*70)
    print("PODSUMOWANIE")
    print("="*70)
    print(f"Przetworzone pliki: {successful}/{total_files}")
    print(f"Błędy: {failed}")
    print(f"Oryginalny rozmiar: {format_size(total_original_size)}")
    print(f"Nowy rozmiar: {format_size(total_new_size)}")
    print(f"Zaoszczędzono: {format_size(total_saved)} ({total_saved_percent:.2f}%)")
    print("="*70)

if __name__ == '__main__':
    main()
