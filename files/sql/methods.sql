CREATE TABLE methods (
    id        INTEGER PRIMARY KEY ON CONFLICT IGNORE AUTOINCREMENT
                      NOT NULL,
    name      TEXT    NOT NULL,
    code      TEXT    NOT NULL,
    namespace TEXT    NOT NULL
);