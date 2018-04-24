# ideo

## Założenia
•	struktura drzewiasta ma umożliwiać działanie na dowolnej ilości poziomów,
Done. Do przechowywania ścieżki węzła wykorzystałem typ ltree
•	funkcje jakie mają być dostępne dla administratora: dodawanie, edycja, usuwania, sortowanie (zarówno węzłów jak i liści), przenoszenie węzłów do innych gałęzi,
Done. Przenoszenie węzłów wykorzystuje Drag and Drop po stronie klienta.
•	powinna być możliwość rozwinięcia całej struktury lub wybranych węzłów,
Done
•	powinny zostać zastosowane zabezpieczenia uniemożliwiające wprowadzanie nieprawidłowych danych,
Done, użyłem PDO oraz htmlspecialchars
•	wskazane zastosowanie skryptów client-side (własnych, nie gotowych rozwiązań jak np. jsTree)
Done
•	obsługa formularzy powinna zawierać klasę do generowania formularzy wraz z wizualizacją, walidacją oraz zabezpieczeniami.
Done
