#!/usr/bin/env python3
"""
Skrypt do generowania miniatur obrazów dla portfolio
Tworzy małe wersje obrazów (thumbnails) które ładują się szybciej
Użycie: python3 generate_thumbnails.py
Wymaga: pip install Pillow
"""
import os
from pathlib import Path
from PIL import Image

# Konfiguracja
THUMBNAIL_SIZE = 300  # maksymalna szerokość/wysokość miniatury w px
THUMBNAIL_QUALITY = 80  # jakość kompresji (1-100, 80 to dobry balans dla szybkości)
THUMBNAIL_FOLDER = 'thumbs'  # nazwa podfolderu dla miniatur

def create_thumbnail(image_path, output_path, size=THUMBNAIL_SIZE):
    """
    Tworzy miniaturę obrazu zachowując proporcje
    """
    try:
        with Image.open(image_path) as img:
            # Zachowaj proporcje - thumbnail() automatycznie dopasowuje
            img.thumbnail((size, size), Image.Resampling.LANCZOS)

            # Zapisz miniaturę
            if img.mode in ('RGBA', 'LA', 'P'):
                # Dla obrazów z przezroczystością
                img.save(output_path, 'WEBP', quality=THUMBNAIL_QUALITY, method=6)
            else:
                # Dla zwykłych obrazów
                img.save(output_path, 'WEBP', quality=THUMBNAIL_QUALITY, method=6)

            return True
    except Exception as e:
        print(f"   ✗ Błąd: {e}")
        return False

def format_size(bytes_size):
    """Formatuje rozmiar w bajtach"""
    for unit in ['B', 'KB', 'MB']:
        if bytes_size < 1024.0:
            return f"{bytes_size:.1f} {unit}"
        bytes_size /= 1024.0
    return f"{bytes_size:.1f} GB"

def process_category(category_path):
    """
    Przetwarza wszystkie obrazy w kategorii
    """
    category_name = category_path.name
    print(f"\n📁 Kategoria: {category_name}")

    # Utwórz folder thumbs
    thumbs_path = category_path / THUMBNAIL_FOLDER
    thumbs_path.mkdir(exist_ok=True)

    # Znajdź wszystkie obrazy
    image_extensions = {'.webp', '.jpg', '.jpeg', '.png'}
    images = [f for f in category_path.iterdir()
              if f.is_file() and f.suffix.lower() in image_extensions]

    if not images:
        print(f"   Brak obrazów do przetworzenia")
        return 0, 0, 0

    print(f"   Znaleziono {len(images)} obrazów")

    created = 0
    skipped = 0
    total_saved = 0

    for i, image_path in enumerate(images, 1):
        output_path = thumbs_path / f"{image_path.stem}.webp"

        # Pomiń jeśli miniatura już istnieje
        if output_path.exists():
            skipped += 1
            continue

        print(f"   [{i}/{len(images)}] {image_path.name}...", end=' ', flush=True)

        original_size = image_path.stat().st_size

        if create_thumbnail(image_path, output_path, THUMBNAIL_SIZE):
            thumb_size = output_path.stat().st_size
            saved = original_size - thumb_size
            total_saved += saved
            created += 1
            print(f"✓ {format_size(thumb_size)} (zaoszczędzono {format_size(saved)})")
        else:
            print(f"✗ Błąd")

    if skipped > 0:
        print(f"   ⏭  Pominięto {skipped} już istniejących miniatur")

    return len(images), created, total_saved

def main():
    base_path = Path('static/images')

    # Kategorie do przetworzenia
    categories = ['rzezby', 'bryly', 'bary', 'pokazy', 'warsztaty', 'products']

    print("="*70)
    print("GENERATOR MINIATUR DLA PORTFOLIO")
    print("="*70)
    print(f"Rozmiar miniatur: {THUMBNAIL_SIZE}x{THUMBNAIL_SIZE}px")
    print(f"Jakość: {THUMBNAIL_QUALITY}%")
    print(f"Folder: {THUMBNAIL_FOLDER}/")

    total_images = 0
    total_created = 0
    total_saved_bytes = 0

    # Przetwórz każdą kategorię
    for category in categories:
        category_path = base_path / category

        if not category_path.exists():
            print(f"\n📁 Kategoria: {category}")
            print(f"   ⚠  Folder nie istnieje, pomijam")
            continue

        images_count, created, saved = process_category(category_path)
        total_images += images_count
        total_created += created
        total_saved_bytes += saved

    # Podsumowanie
    print("\n" + "="*70)
    print("PODSUMOWANIE")
    print("="*70)
    print(f"Całkowita liczba obrazów: {total_images}")
    print(f"Utworzonych miniatur: {total_created}")
    print(f"Zaoszczędzone miejsce: {format_size(total_saved_bytes)}")
    print(f"Średnio na obraz: {format_size(total_saved_bytes / max(total_created, 1))}")
    print("="*70)
    print("\n✅ Gotowe! Możesz teraz uruchomić stronę i sprawdzić wydajność.")

if __name__ == '__main__':
    main()
