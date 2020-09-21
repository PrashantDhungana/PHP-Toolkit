<?php
namespace ElegantMedia\PHPToolkit\Tests\Unit;

use ElegantMedia\PHPToolkit\Exceptions\FileSystem\FileNotFoundException as FileNotFoundExceptionAlias;
use ElegantMedia\PHPToolkit\FileEditor;

class FileManagerTest extends \PHPUnit\Framework\TestCase
{
	private static $file = '_file_manager_test.txt';
	private static $fileContent = 'foo';

	protected function setUp(): void
	{
		parent::setUp();
		file_put_contents(static::$file, static::$fileContent);
	}

	protected function tearDown(): void
	{
		unlink(static::$file);
		parent::tearDown(); // TODO: Change the autogenerated stub
	}

	/**
	 * @test
	 */
	public function testFileEditorisTextInFileRequiresFile()
	{
		$this->expectException(FileNotFoundExceptionAlias::class);
		FileEditor::isTextInFile("_missing.txt", 'foo');
	}

	/**
	 * @test
	 */
	public function testFileEditorisTextInFileIsCaseSensitive()
	{
		$this->assertTrue(FileEditor::isTextInFile(static::$file, static::$fileContent));
		$this->assertFalse(FileEditor::isTextInFile(static::$file, ucfirst(static::$fileContent)));
	}

	/**
	 * @test
	 */
	public function testFileEditorisTextInFileIsCaseInsensitive()
	{
		$this->assertTrue(FileEditor::isTextInFile(static::$file, static::$fileContent, false));
		$this->assertTrue(FileEditor::isTextInFile(static::$file, ucfirst(static::$fileContent), false));
	}

	/**
	 * @test
	 */
	public function testFileEditorAreFilesSimilarRequiresSecondFile()
	{
		$this->assertTrue(file_exists(static::$file));
		$this->expectException(FileNotFoundExceptionAlias::class);
		FileEditor::areFilesSimilar(static::$file, "_missing.txt");
	}

	/**
	 * @test
	 */
	public function testFileEditorAreFilesSimilarRequiresFirstFile()
	{
		$this->assertTrue(file_exists(static::$file));
		$this->expectException(FileNotFoundExceptionAlias::class);
		FileEditor::areFilesSimilar("_missing.txt", static::$file);
	}

	/**
	 * @test
	 */
	public function testFileEditorAreFilesSimilar()
	{
		$differentFile = '_file_manager_different-file.txt';
		file_put_contents($differentFile, 'bar');

		$this->assertFalse(FileEditor::areFilesSimilar(static::$file, $differentFile));

		$similarFile = '_file_manager_similar-file.txt';
		file_put_contents($similarFile, static::$fileContent);

		$this->assertTrue(FileEditor::areFilesSimilar(static::$file, $similarFile));

		unlink($differentFile);
		unlink($similarFile);
	}

	/**
	 * @test
	 */
	public function testFileEditorReadFirstLine()
	{
		$content = "bar";
		$contentWithWhitespace = "{$content}\n";
		file_put_contents(static::$file, $contentWithWhitespace);

		$this->assertNotEquals($content, FileEditor::readFirstLine(static::$file, false));
		$this->assertEquals($contentWithWhitespace, FileEditor::readFirstLine(static::$file, false));
	}

	/**
	 * @test
	 */
	public function testFileEditorReadFirstLineRemovesWhitespace()
	{
		$content = "bar";
		$contentWithWhitespace = "{$content}\n";
		file_put_contents(static::$file, $contentWithWhitespace);

		$this->assertEquals($content, FileEditor::readFirstLine(static::$file));
	}
}
