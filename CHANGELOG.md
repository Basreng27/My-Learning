<!-- Create Extension UUID -->
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

<!-- Table users -->
CREATE TABLE users (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    user_id TEXT NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
ALTER TABLE users ADD COLUMN created_at TIMESTAMP;
ALTER TABLE users ADD COLUMN updated_at TIMESTAMP;
ALTER TABLE users ADD COLUMN deleted_at TIMESTAMP;

<!-- Table menus -->
CREATE TABLE menus (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    parent_id UUID,
    code VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) UNIQUE NOT NULL,
    url VARCHAR(255) NOT NULL,
	icon VARCHAR(255) NOT NULL,
	sequence INT NOT NULL DEFAULT 0,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
	deleted_at TIMESTAMP		
);

<!-- Table roles -->
CREATE TABLE roles (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    code VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) UNIQUE NOT NULL,
    guard_name VARCHAR(255) NOT NULL,
	status BOOLEAN DEFAULT 0,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
	deleted_at TIMESTAMP		
);

<!-- Table user_roles -->
CREATE TABLE user_roles (
    role_id UUID REFERENCES roles (id) ON UPDATE CASCADE ON DELETE CASCADE,
    user_id UUID REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE
);

<!-- Table menu_permision -->
CREATE TABLE menu_permission (
    role_id UUID REFERENCES roles (id) ON UPDATE CASCADE ON DELETE CASCADE,
    menu_id UUID REFERENCES menus (id) ON UPDATE CASCADE ON DELETE CASCADE
);

<!-- Table permissions -->
CREATE TABLE permissions (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    name VARCHAR(255) NOT NULL,
	guard_name VARCHAR(255),
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
	deleted_at TIMESTAMP
);

<!-- Table menu_has_permissions -->
CREATE TABLE menu_has_permissions (
    permission_id UUID REFERENCES permissions (id) ON UPDATE CASCADE ON DELETE CASCADE,
    menu_id UUID REFERENCES menus (id) ON UPDATE CASCADE ON DELETE CASCADE,
	name VARCHAR(255) NOT NULL,
	sequence INT DEFAULT 0
);
