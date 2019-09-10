<?php

namespace DH\DoctrineAuditBundle\Tests\Reader;

use DH\DoctrineAuditBundle\Reader\AuditEntry;
use DH\DoctrineAuditBundle\User\User;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DH\DoctrineAuditBundle\Reader\AuditEntry
 *
 * @internal
 */
final class AuditEntryTest extends TestCase
{
    public function testAccessors(): void
    {
        $entry = new AuditEntry();
        $entry->id = 1;
        $entry->type = 'type';
        $entry->object_id = '1';
        $entry->diffs = '{}';
        $entry->blame_id = 1;
        $entry->blame_user = 'John Doe';
        $entry->blame_user_fqdn = User::class;
        $entry->blame_user_firewall = 'main';
        $entry->ip = '1.2.3.4';
        $entry->created_at = 'now';

        static::assertSame(1, $entry->getId(), 'AuditEntry::getId() is ok.');
        static::assertSame('type', $entry->getType(), 'AuditEntry::getType() is ok.');
        static::assertSame('1', $entry->getObjectId(), 'AuditEntry::getObjectId() is ok.');
        static::assertSame([], $entry->getDiffs(), 'AuditEntry::getDiffs() is ok.');
        static::assertSame(1, $entry->getUserId(), 'AuditEntry::getUserId() is ok.');
        static::assertSame('John Doe', $entry->getUsername(), 'AuditEntry::getUsername() is ok.');
        static::assertSame(User::class, $entry->getUserFqdn(), 'AuditEntry::getUserFqdn() is ok.');
        static::assertSame('main', $entry->getUserFirewall(), 'AuditEntry::getUserFirewall() is ok.');
        static::assertSame('1.2.3.4', $entry->getIp(), 'AuditEntry::getIp() is ok.');
        static::assertSame('now', $entry->getCreatedAt(), 'AuditEntry::getCreatedAt() is ok.');
    }

    public function testUndefinedUser(): void
    {
        $entry = new AuditEntry();

        static::assertNull($entry->getUserId(), 'AuditEntry::getUserId() is ok with undefined user.');
        static::assertNull($entry->getUsername(), 'AuditEntry::getUsername() is ok with undefined user.');
    }

    public function testGetDiffsReturnsAnArray(): void
    {
        $entry = new AuditEntry();
        $entry->diffs = '{}';

        static::assertIsArray($entry->getDiffs(), 'AuditEntry::getDiffs() returns an array.');
    }
}
